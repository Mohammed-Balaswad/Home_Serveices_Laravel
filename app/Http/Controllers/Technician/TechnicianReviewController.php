<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class TechnicianReviewController extends Controller
{
    public function index()
    {
        $technicianId = Auth::id();

        $reviews = Review::with('booking.service','booking.client')
            ->whereHas('booking', function($q) use ($technicianId) {
                $q->where('technician_id', $technicianId);
            })
            ->orderBy('created_at','desc')
            ->paginate(10);

        return view('technician.reviews.index', compact('reviews'));
    }
}