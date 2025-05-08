<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'sender_type',
        'sender_id',
        'receiver_type',
        'receiver_id',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime'
    ];

    public function sender(): MorphTo
    {
        return $this->morphTo();
    }

    public function receiver(): MorphTo
    {
        return $this->morphTo();
    }
    
    /**
     * Get the count of unread messages for a specific user
     *
     * @param string $receiverType
     * @param int $receiverId
     * @param string|null $senderType
     * @param int|null $senderId
     * @return int
     */
    public static function unreadCount(string $receiverType, int $receiverId, ?string $senderType = null, ?int $senderId = null): int
    {
        $query = self::where('receiver_type', $receiverType)
            ->where('receiver_id', $receiverId)
            ->whereNull('read_at');
            
        if ($senderType && $senderId) {
            $query->where('sender_type', $senderType)
                  ->where('sender_id', $senderId);
        }
        
        return $query->count();
    }
}