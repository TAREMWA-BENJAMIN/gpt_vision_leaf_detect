<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageAttachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Chat::with(['creator', 'messages.user', 'messages.attachments', 'messages.replies.user', 'messages.replies.attachments'])
            ->orderByDesc('chat_created_at')
            ->get();

        return view('community.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'chat_topic' => 'required|string|max:255',
            'message_text' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $chat = new Chat();
        $chat->chat_topic = $request->chat_topic;
        $chat->chat_created_at = now();
        $chat->chat_creator_id = Auth::id();
        $chat->save();

        $message = new Message();
        $message->message_chat_id = $chat->id;
        $message->message_user_id = Auth::id();
        $message->message_text = $request->message_text;
        $message->message_datetime = now();
        $message->save();

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('message_attachments', 'public');
            MessageAttachment::create([
                'message_id' => $message->id,
                'attachment_url' => $path,
                'file_type' => $request->file('attachment')->getClientMimeType(),
                'file_size' => $request->file('attachment')->getSize(),
            ]);
        }

        return redirect()->route('community.index')->with('success', 'Topic created successfully!');
    }

    /**
     * Handle a reply to a message.
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'message_text' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $reply = new Message();
        $reply->message_chat_id = $message->message_chat_id; // Associate reply with the same chat as the parent message
        $reply->message_user_id = Auth::id();
        $reply->message_parent_id = $message->id; // Set the parent message ID
        $reply->message_text = $request->message_text;
        $reply->message_datetime = now();
        $reply->save();

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('message_attachments', 'public');
            MessageAttachment::create([
                'message_id' => $reply->id,
                'attachment_url' => $path,
                'file_type' => $request->file('attachment')->getClientMimeType(),
                'file_size' => $request->file('attachment')->getSize(),
            ]);
        }

        return redirect()->back()->with('success', 'Reply posted successfully!');
    }
} 