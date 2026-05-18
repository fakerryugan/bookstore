<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getMessages()
    {
        $userId = Auth::id();

        $messages = Message::where('customer_id', $userId)
            ->with(['sender', 'customer'])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userId = Auth::id();

        $message = Message::create([
            'customer_id' => $userId,
            'sender_id' => $userId,
            'message' => $request->message,
            'is_read' => false
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender')
        ]);
    }

    public function adminIndex()
    {
        return view('admin.chat.index');
    }
    public function adminGetUsers()
    {
        $users = User::where('role', 'costumer')
            ->whereHas('messages')
            ->with(['messages' => function ($query) {
                $query->latest();
            }])
            ->get()
            ->sortByDesc(function ($user) {
                return $user->messages->first() ? $user->messages->first()->created_at : $user->created_at;
            })
            ->values();

        return response()->json($users);
    }
    public function adminGetMessages($customerId)
    {
        $messages = Message::where('customer_id', $customerId)
            ->with(['sender', 'customer'])
            ->orderBy('created_at', 'asc')
            ->get();

        Message::where('customer_id', $customerId)
            ->where('sender_id', $customerId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

 
    public function adminSendMessage(Request $request, $customerId)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $message = Message::create([
            'customer_id' => $customerId,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'is_read' => true
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender')
        ]);
    }
}
