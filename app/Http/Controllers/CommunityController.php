<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ChatReply;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Chat::with(['creator', 'replies.user'])
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
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $chat = new Chat();
        $chat->chat_topic = $request->chat_topic;
        $chat->chat_created_at = now();
        $chat->chat_creator_id = Auth::id();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('chat_attachments', 'public');
            $chat->attachment_url = $path;
            $chat->file_type = $file->getClientMimeType();
            $chat->file_size = $file->getSize();
        }

        $chat->save();

        return redirect()->route('community.index')->with('success', 'Topic created successfully!');
    }

    /**
     * Handle a reply to a topic.
     */
    public function reply(Request $request, Chat $chat)
    {
        $request->validate([
            'content' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $reply = new ChatReply();
        $reply->chat_id = $chat->id;
        $reply->user_id = Auth::id();
        $reply->content = $request->content;
        $reply->created_at = now();

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('chat_reply_attachments', 'public');
            $reply->attachment_url = $path;
            $reply->file_type = $file->getClientMimeType();
            $reply->file_size = $file->getSize();
        }

        $reply->save();

        return redirect()->back()->with('success', 'Reply posted successfully!');
    }

    public function destroy(Chat $community)
    {
        $community->delete();

        return redirect()->route('community.index')->with('success', 'Post deleted successfully.');
    }
} 