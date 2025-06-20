<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageAttachment extends Model
{
    use HasFactory;

    protected $table = 'message_attachment';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'message_id',
        'attachment_url',
        'uploaded_at',
    ];

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }
} 