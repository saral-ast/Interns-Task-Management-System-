<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('user')->user();
        $userType = Auth::guard('admin')->check() ? 'admin' : 'intern';

        // Get all messages where the current user is either sender or receiver
        $messages = Message::where(function($query) use ($user, $userType) {
            $query->where('sender_type', $userType)
                  ->where('sender_id', $user->id);
        })->orWhere(function($query) use ($user, $userType) {
            $query->where('receiver_type', $userType)
                  ->where('receiver_id', $user->id);
        })->orderBy('created_at', 'desc')->get();

        // Get all admins and interns for the chat list
        $admins = Admin::all();
        $interns = User::all();

        return view('chat.index', [
            'messages' => $messages,
            'admins' => $admins,
            'interns' => $interns,
            'currentUser' => $user,
            'userType' => $userType
        ]);
    }

    public function store(Request $request)
    {
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
    }

    public function markAsRead(Message $message)
    {
        $user = Auth::guard('admin')->check() ? Auth::guard('admin')->user() : Auth::guard('user')->user();
        $userType = Auth::guard('admin')->check() ? 'admin' : 'intern';

        if ($message->receiver_type === $userType && $message->receiver_id === $user->id) {
            $message->update(['read_at' => now()]);
        }

        return response()->json(['success' => true]);
    }

    public function getMessages(Request $request)
    {
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
    }
}