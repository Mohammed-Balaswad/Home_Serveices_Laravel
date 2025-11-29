<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TechnicianBookingController extends Controller
{
    public function index(Request $request)
    {
        $technician = Auth::user();

        $query = Booking::with(['client', 'service'])
            ->where('technician_id', $technician->id)
            ->orderBy('date', 'desc');

        // فلترة بالحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فلترة بالتاريخ
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        $bookings = $query->paginate(12)->withQueryString();

        return view('technician.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $technicianId = Auth::id();

        $booking = Booking::with(['client', 'service', 'review'])
            ->where('technician_id', $technicianId)
            ->findOrFail($id);

        return view('technician.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $technicianId = Auth::id();

        $booking = Booking::where('technician_id', $technicianId)->findOrFail($id);

        $request->validate([
            'status' => ['required', Rule::in(['pending','accepted','rejected','completed','cancelled'])],
            'agreed_price' => 'nullable|numeric|min:0',
        ]);

        $booking->status = $request->status;

        if ($request->filled('agreed_price')) {
            $booking->agreed_price = $request->agreed_price; // نستخدم نفس عمود السعر
        }

        $booking->save();

        return back()->with('success', 'تم تحديث حالة الحجز بنجاح');
    }
}