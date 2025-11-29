<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianScheduleController extends Controller
{
    public function index()
    {
        $technicianId = Auth::id();

        // المواعيد المرتبطة بالفني
        $schedules = Schedule::with('booking.client', 'booking.service')
            ->where('technician_id', $technicianId)
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->paginate(10);

        // الحجوزات المتاحة للفني (معلقة أو مقبولة)
        $bookings = Booking::with('client','service')
            ->where('technician_id', $technicianId)
            ->whereIn('status', ['pending','accepted'])
            ->get();

        return view('technician.schedules.index', compact('schedules','bookings'));
    }

    public function store(Request $request)
    {
        $technicianId = Auth::id();

        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'booking_id' => 'nullable|exists:bookings,id',
        ]);

        Schedule::create([
            'technician_id' => $technicianId,
            'date' => $request->date,
            'time' => $request->time,
            'booking_id' => $request->booking_id,
            'is_confirmed' => false,
        ]);

        return back()->with('success', 'تم إضافة الموعد بنجاح');
    }

    public function destroy($id)
    {
        $technicianId = Auth::id();

        $schedule = Schedule::where('technician_id', $technicianId)->findOrFail($id);
        $schedule->delete();

        return back()->with('success', 'تم حذف الموعد بنجاح');
    }

    public function confirm($id)
    {
        $technicianId = Auth::id();

        $schedule = Schedule::where('technician_id', $technicianId)->findOrFail($id);
        $schedule->is_confirmed = true;
        $schedule->save();

        return back()->with('success', 'تم تأكيد الموعد');
    }
}