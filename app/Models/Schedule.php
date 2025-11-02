<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'technician_id',
        'booking_id',
        'date',
        'time',
        'is_confirmed',
    ];

    //  الجدول يخص فني واحد
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    //  الموعد قد يكون مرتبط بحجز معين
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
