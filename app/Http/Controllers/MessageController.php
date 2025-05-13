<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        try {
            $isAdmin = Auth::guard('admin')->check();
            $user = $isAdmin ? Auth::guard('admin')->user() : Auth::guard('user')->user();
            $userType = $isAdmin ? 'admin' : 'intern';

            // Get all admins with eager loading
            $admins = Admin::all();
            $interns = User::all();
            
            // Get all unread message counts in a single query for better performance
            if ($isAdmin) {
                // Get unread counts for all admin's conversations in a single query
                $adminUnreadCounts = Message::whereNull('read_at')
                    ->where('receiver_type', $userType)
                    ->where('receiver_id', $user->id)
                    ->select('sender_type', 'sender_id', DB::raw('count(*) as unread_count'))
                    ->groupBy('sender_type', 'sender_id')
                    ->get()
                    ->keyBy(function ($item) {
                        return $item->sender_type . '_' . $item->sender_id;
                    });
                
                // Attach counts to admin and intern collections
                $admins->each(function($admin) use ($adminUnreadCounts) {
                    $key = 'admin_' . $admin->id;
                    $admin->unread_count = $adminUnreadCounts->has($key) ? $adminUnreadCounts[$key]->unread_count : 0;
                });
                
                $interns->each(function($intern) use ($adminUnreadCounts) {
                    $key = 'intern_' . $intern->id;
                    $intern->unread_count = $adminUnreadCounts->has($key) ? $adminUnreadCounts[$key]->unread_count : 0;
                });
            } else {
                // For interns, only get counts for admin conversations
                $internUnreadCounts = Message::whereNull('read_at')
                    ->where('receiver_type', $userType)
                    ->where('receiver_id', $user->id)
                    ->where('sender_type', 'admin')
                    ->select('sender_id', DB::raw('count(*) as unread_count'))
                    ->groupBy('sender_id')
                    ->get()
                    ->keyBy('sender_id');
                
                $admins->each(function($admin) use ($internUnreadCounts) {
                    $admin->unread_count = $internUnreadCounts->has($admin->id) ? $internUnreadCounts[$admin->id]->unread_count : 0;
                });
            }

            return view('chat.index', [
                'admins' => $admins,
                'interns' => $interns,
                'currentUser' => $user,
                'userType' => $userType
            ]);
        } catch (Exception $e) {
            Log::error('Error in chat index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the chat. Please try again.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required|string',
                'receiver_type' => 'required|in:admin,intern',
                'receiver_id' => 'required|integer'
            ]);

            $sender = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('user')->user();
            $senderType = Auth::guard('admin')->check() ? 'admin' : 'intern';

            $message = Message::create([
                'content' => $request->content,
                'sender_type' => $senderType,
                'sender_id' => $sender->id,
                'receiver_type' => $request->receiver_type,
                'receiver_id' => $request->receiver_id
            ]);

            // Broadcast the message and ensure it executes immediately
            broadcast(new MessageSent($message))->toOthers();

            return response()->json($message);
        } catch (Exception $e) {
            Log::error('Error storing message: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }

    public function markAsRead(Message $message)
    {
        try {
            $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('user')->user();
            $userType = Auth::guard('admin')->check() ? 'admin' : 'intern';

            if ($message->receiver_type === $userType && $message->receiver_id === $user->id) {
                $message->update(['read_at' => now()]);
            }

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::error('Error marking message as read: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to mark message as read'], 500);
        }
    }

    public function getMessages(Request $request)
    {
        try {
            $request->validate([
                'receiver_type' => 'required|in:admin,intern',
                'receiver_id' => 'required|integer'
            ]);

            $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('user')->user();
            $userType = Auth::guard('admin')->check() ? 'admin' : 'intern';

            $messages = Message::where(function($query) use ($user, $userType, $request) {
                $query->where('sender_type', $userType)
                    ->where('sender_id', $user->id)
                    ->where('receiver_type', $request->receiver_type)
                    ->where('receiver_id', $request->receiver_id);
            })->orWhere(function($query) use ($user, $userType, $request) {
                $query->where('receiver_type', $userType)
                    ->where('receiver_id', $user->id)
                    ->where('sender_type', $request->receiver_type)
                    ->where('sender_id', $request->receiver_id);
            })->orderBy('created_at', 'asc')->get();

            return response()->json($messages);
        } catch (Exception $e) {
            Log::error('Error getting messages: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve messages'], 500);
        }
    }

    public function getUnreadCounts(Request $request)
    {
        try {
            $isAdmin = Auth::guard('admin')->check();
            $user = $isAdmin ? Auth::guard('admin')->user() : Auth::guard('user')->user();
            $userType = $isAdmin ? 'admin' : 'intern';
            
            $unreadCounts = [];
            
            // Get all unread message counts in a single query
            if ($isAdmin) {
                // Fetch all unread counts for the admin in a single query
                $counts = Message::whereNull('read_at')
                    ->where('receiver_type', $userType)
                    ->where('receiver_id', $user->id)
                    ->select('sender_type', 'sender_id', DB::raw('count(*) as count'))
                    ->groupBy('sender_type', 'sender_id')
                    ->get();
                
                // Convert to the expected format
                foreach ($counts as $row) {
                    $unreadCounts[$row->sender_type . '_' . $row->sender_id] = $row->count;
                }
            } else {
                // For interns, only fetch admin counts
                $counts = Message::whereNull('read_at')
                    ->where('receiver_type', $userType)
                    ->where('receiver_id', $user->id)
                    ->where('sender_type', 'admin')
                    ->select('sender_id', DB::raw('count(*) as count'))
                    ->groupBy('sender_id')
                    ->get();
                
                // Convert to the expected format
                foreach ($counts as $row) {
                    $unreadCounts['admin_' . $row->sender_id] = $row->count;
                }
            }
            
            return response()->json($unreadCounts);
        } catch (Exception $e) {
            Log::error('Error getting unread counts: ' . $e->getMessage());
            return response()->json([], 500);
        }
    }

    /**
     * Get the total count of unread messages for the current user
     *
     * @return int
     */
    public function getTotalUnreadCount()
    {
        try {
            $isAdmin = Auth::guard('admin')->check();
            $user = $isAdmin ? Auth::guard('admin')->user() : Auth::guard('user')->user();
            $userType = $isAdmin ? 'admin' : 'intern';
            
            $count = Message::where('receiver_type', $userType)
                ->where('receiver_id', $user->id)
                ->whereNull('read_at')
                ->count();
                
            return response()->json($count);
        } catch (Exception $e) {
            Log::error('Error getting total unread count: ' . $e->getMessage());
            return response()->json(0, 500);
        }
    }
}