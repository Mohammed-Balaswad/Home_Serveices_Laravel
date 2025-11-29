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
    return $this->belongsTo(User::class, 'technician_id');
    }
}
