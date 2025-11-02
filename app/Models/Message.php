<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'booking_id',
        'message',
    ];

    //  المرسل
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    //  المستقبل
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    //  الرسالة تخص حجزًا معينًا
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
