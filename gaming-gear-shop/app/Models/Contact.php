<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    const STATUS_NEW = 'new';
    const STATUS_REPLIED = 'replied';
    const STATUS_CLOSED = 'closed'; 

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
        'replied_at',
        'replied_by_user_id',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
    ];

     public function getStatusTextAttribute(): string
     {
         switch ($this->status) {
             case self::STATUS_REPLIED: return 'Đã phản hồi';
             case self::STATUS_CLOSED: return 'Đã đóng';
             case self::STATUS_NEW:
             default: return 'Mới';
         }
     }

     public function getStatusClassAttribute(): string
     {
         switch ($this->status) {
             case self::STATUS_REPLIED: return 'success';
             case self::STATUS_CLOSED: return 'secondary';
             case self::STATUS_NEW:
             default: return 'info';
         }
     }
}