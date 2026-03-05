<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Show conversation in Blade
    public function index(Conversation $conversation)
    {
        // Load messages so Blade can loop over them
        $conversation->load('messages');

        return view('citizen.chat', compact('conversation'));
    }

    // Send a new message via AJAX
    public function send(Request $request, Conversation $conversation)
    {
        $request->validate([
            'body' => 'required|string'
        ]);

        $message = $conversation->messages()->create([
            'sender_id'   => Auth::id(),
            'sender_type' => get_class(Auth::user()),
            'body'        => $request->input('body'),
        ]);

        // Broadcast event for real-time updates
        broadcast(new NewChatMessage($message))->toOthers();

        return response()->json($message);
    }
}