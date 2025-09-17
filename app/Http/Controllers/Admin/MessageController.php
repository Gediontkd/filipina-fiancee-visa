<?php
// app/Http/Controllers/Admin/MessageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\UserSubmittedApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display all messages or conversation threads
     */
    public function index(Request $request)
    {
        try {
            $query = Message::with(['user', 'admin', 'application.visaApplication']);

            // Filter by user
            if ($request->filled('user_id')) {
                $query->where('user_id', $request->user_id);
            }

            // Filter by application
            if ($request->filled('application_id')) {
                $query->where('application_id', $request->application_id);
            }

            // Filter by sender type
            if ($request->filled('sender_type')) {
                $query->where('sender_type', $request->sender_type);
            }

            // Filter by read status
            if ($request->filled('read_status')) {
                if ($request->read_status === 'unread') {
                    $query->unread();
                } elseif ($request->read_status === 'read') {
                    $query->read();
                }
            }

            // Filter by priority
            if ($request->filled('priority')) {
                $query->where('priority', $request->priority);
            }

            $messages = $query->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends($request->all());

            // Get filter options
            $users = User::select('id', 'name', 'email')->get();
            $applications = UserSubmittedApplication::with('visaApplication')
                ->select('id', 'application_id', 'user_id')
                ->get();

            // Get conversation stats
            $stats = [
                'total_messages' => Message::count(),
                'unread_messages' => Message::unread()->count(),
                'user_messages' => Message::bySenderType('user')->count(),
                'admin_messages' => Message::bySenderType('admin')->count(),
            ];

            return view('admin.messages.index', compact(
                'messages', 
                'users', 
                'applications', 
                'stats'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load messages: ' . $e->getMessage());
        }
    }

    /**
     * Show conversation for specific user and application
     */
    public function conversation(Request $request, $userId, $applicationId)
    {
        try {
            $user = User::findOrFail($userId);
            $application = UserSubmittedApplication::with('visaApplication')->findOrFail($applicationId);

            // Verify the application belongs to the user
            if ($application->user_id !== $user->id) {
                return back()->with('error', 'Invalid application for this user.');
            }

            $messages = Message::inConversation($userId, $applicationId)
                ->with(['admin'])
                ->get();

            // Mark admin messages as read (since admin is viewing)
            Message::where('user_id', $userId)
                ->where('application_id', $applicationId)
                ->where('sender_type', 'user')
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return view('admin.messages.conversation', compact(
                'user', 
                'application', 
                'messages'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load conversation: ' . $e->getMessage());
        }
    }

    /**
     * Send a new message to user
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'application_id' => 'required|exists:user_submitted_applications,id',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                'priority' => 'required|in:low,normal,high',
                'is_important' => 'boolean',
                'attachments.*' => 'file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,txt',
            ]);

            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('message-attachments', $filename, 'public');
                    
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => $filename,
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                    ];
                }
            }

            Message::create([
                'user_id' => $request->user_id,
                'admin_id' => Auth::guard('admin')->id(),
                'application_id' => $request->application_id,
                'sender_type' => 'admin',
                'subject' => $request->subject,
                'message' => $request->message,
                'priority' => $request->priority,
                'is_important' => $request->boolean('is_important'),
                'attachments' => $attachments,
            ]);

            return back()->with('success', 'Message sent successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to send message: ' . $e->getMessage());
        }
    }

    /**
     * Reply to a message
     */
    public function reply(Request $request, Message $message)
    {
        try {
            $request->validate([
                'reply_message' => 'required|string',
                'priority' => 'in:low,normal,high',
                'attachments.*' => 'file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,txt',
            ]);

            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('message-attachments', $filename, 'public');
                    
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name' => $filename,
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                    ];
                }
            }

            Message::create([
                'user_id' => $message->user_id,
                'admin_id' => Auth::guard('admin')->id(),
                'application_id' => $message->application_id,
                'sender_type' => 'admin',
                'subject' => 'Re: ' . $message->subject,
                'message' => $request->reply_message,
                'priority' => $request->priority ?? 'normal',
                'attachments' => $attachments,
            ]);

            return back()->with('success', 'Reply sent successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to send reply: ' . $e->getMessage());
        }
    }

    /**
     * Mark message as read
     */
    public function markAsRead(Message $message)
    {
        $message->markAsRead();
        
        return response()->json(['success' => true]);
    }

    /**
     * Mark all messages as read
     */
    public function markAllAsRead(Request $request)
    {
        $query = Message::unread();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('application_id')) {
            $query->where('application_id', $request->application_id);
        }

        $query->update(['read_at' => now()]);

        return back()->with('success', 'All messages marked as read.');
    }

    /**
     * Download message attachment
     */
    public function downloadAttachment(Message $message, $attachmentIndex)
    {
        try {
            $attachments = $message->attachments ?? [];
            
            if (!isset($attachments[$attachmentIndex])) {
                return back()->with('error', 'Attachment not found.');
            }

            $attachment = $attachments[$attachmentIndex];
            $filePath = $attachment['path'];

            if (!Storage::disk('public')->exists($filePath)) {
                return back()->with('error', 'File not found on server.');
            }

            return Storage::disk('public')->download(
                $filePath, 
                $attachment['original_name']
            );

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to download attachment: ' . $e->getMessage());
        }
    }

    /**
     * Delete a message
     */
    public function destroy(Message $message)
    {
        try {
            // Delete attachments from storage
            if ($message->hasAttachments()) {
                foreach ($message->attachments as $attachment) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }

            $message->delete();

            return back()->with('success', 'Message deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete message: ' . $e->getMessage());
        }
    }

    /**
     * Get unread message count for specific user/application
     */
    public function getUnreadCount(Request $request)
    {
        $query = Message::unread();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('application_id')) {
            $query->where('application_id', $request->application_id);
        }

        $count = $query->count();

        return response()->json(['unread_count' => $count]);
    }
}