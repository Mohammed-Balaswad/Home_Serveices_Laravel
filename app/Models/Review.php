<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'booking_id',
        'rating',
        'comment',
    ];

    //  التقييم مرتبط بحجز واحد
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    //  الفني الذي تم تقييمه (من خلال الحجز)
    public function technician()
    {
        return $this->hasOneThrough(
            User::class,
            Booking::class,
            'id',            // المفتاح المحلي في جدول bookings
            'id',            // المفتاح المحلي في جدول users
            'booking_id',    // المفتاح في جدول reviews
            'technician_id'  // المفتاح في جدول bookings
        );
    }
}
