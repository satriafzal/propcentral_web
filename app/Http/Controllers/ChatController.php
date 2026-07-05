<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $conversations = $user->conversations()->orderByDesc('last_message_at')->get();
        return view('chat.index', compact('conversations'));
    }

    public function show($userId)
    {
        $otherUser = User::findOrFail($userId);
        $currentUserId = Auth::id();

        if ($currentUserId == $userId) {
            return redirect('/')->with('error', 'You cannot chat with yourself.');
        }

        $conversation = Conversation::where(function ($query) use ($currentUserId, $userId) {
            $query->where('user_one_id', $currentUserId)->where('user_two_id', $userId);
        })->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('user_one_id', $userId)->where('user_two_id', $currentUserId);
        })->first();

        $messages = $conversation ? $conversation->messages()->orderBy('created_at', 'asc')->get() : collect([]);

        if ($conversation) {
            $conversation->messages()->where('sender_id', $userId)->where('is_read', false)->update(['is_read' => true]);
        }

        return view('chat.show', compact('otherUser', 'conversation', 'messages'));
    }

    public function sendMessage(Request $request, $userId)
    {
        $request->validate([
            'body' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $currentUserId = Auth::id();

        if ($currentUserId == $userId) {
            return response()->json(['error' => 'Cannot chat with yourself'], 400);
        }

        $userOne = min($currentUserId, $userId);
        $userTwo = max($currentUserId, $userId);

        $conversation = Conversation::firstOrCreate(
            ['user_one_id' => $userOne, 'user_two_id' => $userTwo]
        );

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chat_images', 'public');
        }
        
        $message = $conversation->messages()->create([
            'sender_id' => $currentUserId,
            'body' => $request->body,
            'is_read' => false,
            'image' => $imagePath,
        ]);

        $conversation->update(['last_message_at' => now()]);

        broadcast(new \App\Events\MessageSent($message, $userId));

        return response()->json([
            'success' => true,
            'message' => $message->load('sender'),
        ]);
    }

    public function fetchMessages(Request $request, $userId)
    {
        $currentUserId = Auth::id();

        $conversation = Conversation::where(function ($query) use ($currentUserId, $userId) {
            $query->where('user_one_id', $currentUserId)->where('user_two_id', $userId);
        })->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('user_one_id', $userId)->where('user_two_id', $currentUserId);
        })->first();

        if (!$conversation) {
            return response()->json(['messages' => []]);
        }

        $query = $conversation->messages()->with('sender')->orderBy('created_at', 'asc');

        if ($request->has('last_id')) {
            $query->where('id', '>', $request->last_id);
        }

        $messages = $query->get();

        if ($messages->count() > 0) {
            $messageIds = $messages->where('sender_id', $userId)->pluck('id');
            if ($messageIds->count() > 0) {
                 Message::whereIn('id', $messageIds)->update(['is_read' => true]);
            }
        }

        return response()->json([
            'messages' => $messages,
        ]);
    }
}
