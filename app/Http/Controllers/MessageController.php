<?php
// app/Http/Controllers/MessageController.php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display user's messages for their applications
     */
    public function index(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Get user's applications
            $applications = UserSubmittedApplication::where('user_id', $user->id)
                ->with('visaApplication')
                ->get();

            $query = Message::where('user_id', $user->id)
                ->with(['admin', 'application.visaApplication']);

            // Filter by application
            if ($request->filled('application_id')) {
                $query->where('application_id', $request->application_id);
            }

            // Filter by read status
            if ($request->filled('read_status')) {
                if ($request->read_status === 'unread') {
                    $query->unread();
                } elseif ($request->read_status === 'read') {
                    $query->read();
                }
            }

            $messages = $query->orderBy('created_at', 'desc')
                ->paginate(10)
                ->appends($request->all());

            // Get message stats
            $stats = [
                'total_messages' => Message::where('user_id', $user->id)->count(),
                'unread_messages' => Message::where('user_id', $user->id)->unread()->count(),
                'from_admin' => Message::where('user_id', $user->id)->bySenderType('admin')->count(),
            ];

            return view('web.messages.index', compact(
                'messages', 
                'applications', 
                'stats'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load messages: ' . $e->getMessage());
        }
    }

    /**
     * Show conversation for specific application
     */
    public function conversation(Request $request, $applicationId)
    {
        try {
            $user = Auth::user();
            $application = UserSubmittedApplication::where('user_id', $user->id)
                ->where('id', $applicationId)
                ->with('visaApplication')
                ->firstOrFail();

            $messages = Message::inConversation($user->id, $applicationId)
                ->with(['admin'])
                ->get();

            // Mark admin messages as read (since user is viewing)
            Message::where('user_id', $user->id)
                ->where('application_id', $applicationId)
                ->where('sender_type', 'admin')
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return view('web.messages.conversation', compact(
                'application', 
                'messages'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load conversation: ' . $e->getMessage());
        }
    }

    /**
     * Send a new message to admin
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $request->validate([
                'application_id' => 'required|exists:user_submitted_applications,id',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                'priority' => 'in:low,normal,high',
                'attachments.*' => 'file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,txt',
            ]);

            // Verify application belongs to user
            $application = UserSubmittedApplication::where('user_id', $user->id)
                ->where('id', $request->application_id)
                ->firstOrFail();

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
                'user_id' => $user->id,
                'application_id' => $request->application_id,
                'sender_type' => 'user',
                'subject' => $request->subject,
                'message' => $request->message,
                'priority' => $request->priority ?? 'normal',
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
            $user = Auth::user();

            // Verify message belongs to user
            if ($message->user_id !== $user->id) {
                return back()->with('error', 'Unauthorized access.');
            }

            $request->validate([
                'reply_message' => 'required|string',
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
                'user_id' => $user->id,
                'application_id' => $message->application_id,
                'sender_type' => 'user',
                'subject' => 'Re: ' . $message->subject,
                'message' => $request->reply_message,
                'priority' => 'normal',
                'attachments' => $attachments,
            ]);

            return back()->with('success', 'Reply sent successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to send reply: ' . $e->getMessage());
        }
    }

    /**
     * Download message attachment
     */
    public function downloadAttachment(Message $message, $attachmentIndex)
    {
        try {
            $user = Auth::user();

            // Verify message belongs to user
            if ($message->user_id !== $user->id) {
                return back()->with('error', 'Unauthorized access.');
            }

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
     * Mark message as read
     */
    public function markAsRead(Message $message)
    {
        $user = Auth::user();

        // Verify message belongs to user
        if ($message->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->markAsRead();
        
        return response()->json(['success' => true]);
    }

    /**
     * Get unread message count for user
     */
    public function getUnreadCount(Request $request)
    {
        $user = Auth::user();
        
        $query = Message::where('user_id', $user->id)->unread();

        if ($request->filled('application_id')) {
            $query->where('application_id', $request->application_id);
        }

        $count = $query->count();

        return response()->json(['unread_count' => $count]);
    }

    /**
     * Show compose message form
     */
    public function compose(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Get user's applications
            $applications = UserSubmittedApplication::where('user_id', $user->id)
                ->with('visaApplication')
                ->get();

            $selectedApplication = null;
            if ($request->filled('application_id')) {
                $selectedApplication = $applications->where('id', $request->application_id)->first();
            }

            return view('web.messages.compose', compact(
                'applications', 
                'selectedApplication'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load compose form: ' . $e->getMessage());
        }
    }
}