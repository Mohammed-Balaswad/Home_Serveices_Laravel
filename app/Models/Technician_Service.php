<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Technician_Service extends Pivot
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'technician_services';

    protected $fillable = [
        'technician_id',
        'service_id',
        'price',
    ];

    //  الفني
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    //  الخدمة
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
