<?php
// app/Http/Controllers/Admin/UserPdfStoreController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserPdfStoreController extends Controller
{
    /**
     * Base path for PDF storage
     */
    private function getBasePath(): string
    {
        return resource_path('views/pdf');
    }

    /**
     * Get user-specific PDF directory
     */
    private function getUserPdfPath(int $userId): string
    {
        return $this->getBasePath() . '/user_' . $userId;
    }

    /**
     * Display the PDF management page
     */
    public function index(Request $request)
    {
        // Get all users (or you can filter by users with applications if needed)
        $users = User::orderBy('name')->get(['id', 'name', 'email']);

        // If user_id is provided, get their PDFs
        $selectedUserId = $request->get('user_id');
        $userPdfs = [];
        $selectedUser = null;
        $folderExists = false;

        if ($selectedUserId) {
            $selectedUser = User::find($selectedUserId);
            if ($selectedUser) {
                $userPdfPath = $this->getUserPdfPath($selectedUserId);
                $folderExists = File::exists($userPdfPath);
                
                if ($folderExists) {
                    $userPdfs = $this->getUserPdfList($selectedUserId);
                }
            }
        }

        // Get storage statistics
        $stats = $this->getStorageStats();

        return view('admin.pdf-store.index', compact(
            'users',
            'selectedUserId',
            'selectedUser',
            'userPdfs',
            'folderExists',
            'stats'
        ));
    }

    /**
     * Get list of PDFs for a user
     */
    public function getUserPdfs($userId)
    {
        $userPdfPath = $this->getUserPdfPath($userId);
        $folderExists = File::exists($userPdfPath);
        $pdfs = [];

        Log::info('Getting PDFs for user', [
            'user_id' => $userId,
            'path' => $userPdfPath,
            'folder_exists' => $folderExists
        ]);

        if ($folderExists) {
            $pdfs = $this->getUserPdfList($userId);
            Log::info('PDFs found', [
                'user_id' => $userId,
                'count' => count($pdfs),
                'files' => array_column($pdfs, 'name')
            ]);
        }

        $user = User::find($userId);

        return response()->json([
            'success' => true,
            'user' => $user ? ['id' => $user->id, 'name' => $user->name] : null,
            'folder_exists' => $folderExists,
            'path' => $userPdfPath, // Added for debugging
            'pdfs' => $pdfs,
            'count' => count($pdfs)
        ]);
    }

    /**
     * Upload PDF file(s) for a user
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'pdf_files' => 'required',
            'pdf_files.*' => 'required|file|mimes:pdf|max:10240' // 10MB max per file
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = $request->user_id;
            $userPdfPath = $this->getUserPdfPath($userId);

            // Check if folder exists
            if (!File::exists($userPdfPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'User PDF folder does not exist. Please contact system administrator.'
                ], 404);
            }

            $uploadedFiles = [];
            $files = $request->file('pdf_files');

            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = $this->generateUniqueFilename($userPdfPath, $originalName);
                
                // Move file to user folder
                $file->move($userPdfPath, $filename);
                
                $uploadedFiles[] = [
                    'name' => $filename,
                    'original_name' => $originalName,
                    'size' => File::size($userPdfPath . '/' . $filename),
                    'size_formatted' => $this->formatBytes(File::size($userPdfPath . '/' . $filename))
                ];
            }

            Log::info('PDFs uploaded', [
                'user_id' => $userId,
                'count' => count($uploadedFiles),
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => count($uploadedFiles) . ' file(s) uploaded successfully',
                'files' => $uploadedFiles,
                'pdfs' => $this->getUserPdfList($userId)
            ]);

        } catch (\Exception $e) {
            Log::error('PDF upload failed', [
                'user_id' => $request->user_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a PDF file
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'filename' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $userId = $request->user_id;
            $filename = $request->filename;
            $filePath = $this->getUserPdfPath($userId) . '/' . $filename;

            // Security check: ensure file is within user folder
            $realPath = realpath($filePath);
            $userPath = realpath($this->getUserPdfPath($userId));

            if (!$realPath || !$userPath || strpos($realPath, $userPath) !== 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid file path'
                ], 403);
            }

            if (!File::exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File not found'
                ], 404);
            }

            File::delete($filePath);

            Log::info('PDF deleted', [
                'user_id' => $userId,
                'filename' => $filename,
                'admin_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'File deleted successfully',
                'pdfs' => $this->getUserPdfList($userId)
            ]);

        } catch (\Exception $e) {
            Log::error('PDF deletion failed', [
                'user_id' => $request->user_id,
                'filename' => $request->filename,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Deletion failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Download a single PDF file
     */
    public function download($userId, $filename)
    {
        try {
            $filePath = $this->getUserPdfPath($userId) . '/' . $filename;

            // Security check
            $realPath = realpath($filePath);
            $userPath = realpath($this->getUserPdfPath($userId));

            if (!$realPath || !$userPath || strpos($realPath, $userPath) !== 0) {
                abort(403, 'Invalid file path');
            }

            if (!File::exists($filePath)) {
                abort(404, 'File not found');
            }

            return response()->download($filePath, $filename);

        } catch (\Exception $e) {
            Log::error('PDF download failed', [
                'user_id' => $userId,
                'filename' => $filename,
                'error' => $e->getMessage()
            ]);

            abort(500, 'Download failed');
        }
    }

    /**
     * Get PDF list for a user
     */
    private function getUserPdfList(int $userId): array
    {
        $userPdfPath = $this->getUserPdfPath($userId);

        if (!File::exists($userPdfPath)) {
            Log::warning('User PDF path does not exist', [
                'user_id' => $userId,
                'path' => $userPdfPath
            ]);
            return [];
        }

        // Try to get all PDF files
        $pdfGlob = $userPdfPath . '/*.pdf';
        $files = File::glob($pdfGlob);
        
        Log::info('Scanning for PDFs', [
            'user_id' => $userId,
            'path' => $userPdfPath,
            'glob_pattern' => $pdfGlob,
            'files_found' => count($files),
            'raw_files' => $files
        ]);

        $pdfs = [];

        foreach ($files as $file) {
            $pdfs[] = [
                'name' => basename($file),
                'path' => $file,
                'size' => File::size($file),
                'size_formatted' => $this->formatBytes(File::size($file)),
                'modified' => File::lastModified($file),
                'modified_formatted' => date('M j, Y g:i A', File::lastModified($file))
            ];
        }

        // Sort by name
        usort($pdfs, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        return $pdfs;
    }

    /**
     * Generate unique filename to avoid overwriting
     */
    private function generateUniqueFilename(string $path, string $originalName): string
    {
        $filename = $originalName;
        $counter = 1;

        while (File::exists($path . '/' . $filename)) {
            $info = pathinfo($originalName);
            $filename = $info['filename'] . '_' . $counter . '.' . $info['extension'];
            $counter++;
        }

        return $filename;
    }

    /**
     * Format bytes to human readable
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes > 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get storage statistics
     */
    private function getStorageStats(): array
    {
        $basePath = $this->getBasePath();
        $totalSize = 0;
        $totalFiles = 0;
        $userFolders = 0;

        if (File::exists($basePath)) {
            $directories = File::directories($basePath);
            
            foreach ($directories as $dir) {
                if (preg_match('/user_\d+$/', $dir)) {
                    $userFolders++;
                    $files = File::glob($dir . '/*.pdf');
                    $totalFiles += count($files);
                    
                    foreach ($files as $file) {
                        $totalSize += File::size($file);
                    }
                }
            }
        }

        return [
            'total_files' => $totalFiles,
            'total_size' => $totalSize,
            'total_size_formatted' => $this->formatBytes($totalSize),
            'user_folders' => $userFolders
        ];
    }
}