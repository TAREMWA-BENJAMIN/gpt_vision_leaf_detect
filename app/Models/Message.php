<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $table = 'message';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'message_chat_id',
        'message_user_id',
        'message_text',
        'message_datetime',
        'message_parent_id',
    ];

    protected $casts = [
        'message_datetime' => 'datetime',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class, 'message_chat_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'message_user_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_parent_id', 'id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Message::class, 'message_parent_id', 'id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class, 'message_id', 'id');
    }
} 