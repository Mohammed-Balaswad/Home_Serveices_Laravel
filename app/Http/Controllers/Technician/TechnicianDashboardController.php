<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Technician_Service;

class TechnicianDashboardController extends Controller
{
    public function index()
    {
        $technicianId = Auth::id();

        // عدد الحجوزات
        $bookingsCount = Booking::where('technician_id', $technicianId)->count();

        // عدد الخدمات المقدمة
        $servicesCount = Technician_Service::where('technician_id', $technicianId)->count();

        // متوسط التقييمات
        $averageRating = Review::whereHas('booking', function($q) use ($technicianId) {
            $q->where('technician_id', $technicianId);
        })->avg('rating');

        return view('technician.dashboard', compact(
            'bookingsCount',
            'servicesCount',
            'averageRating'
        ));
    }

}
