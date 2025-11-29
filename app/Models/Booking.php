<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'client_id',
        'technician_id',
        'service_id',
        'date',
        'time',
        'agreed_price',
        'status',
        'notes',
    ];

    /**
     * علاقات الجدول.
     */

    //  الحجز ينتمي إلى العميل الذي أنشأه
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    //  الحجز ينتمي إلى الفني الذي سيقوم بالخدمة
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    //  الحجز يخص خدمة معينة
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    //  كل حجز يمكن أن يكون له تقييم بعد إتمامه
    public function review()
    {
        return $this->hasOne(Review::class);
    }

    //  يمكن أن يرتبط الحجز بجدول المواعيد (schedule)
    // لتحديد الفترات الزمنية المحجوزة للفني
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
