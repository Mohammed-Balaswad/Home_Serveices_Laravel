<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ClientBookingController extends Controller
{
    public function index()
    {
        return view('client.bookings.index', [
            'bookings' => Booking::where('client_id', Auth::id())
                ->with(['service', 'technician'])
                ->latest()
                ->paginate(15)
        ]);
    }

    public function create()
    {
        return view('client.bookings.create', [
            'services' => Service::all(),
            'technicians' => User::where('role', 'technician')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'technician_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => 'required',
            'notes' => 'nullable|string'
        ]);

        Booking::create([
            'client_id' => Auth::id(),
            'service_id' => $request->service_id,
            'technician_id' => $request->technician_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect()->route('client.bookings.index')
            ->with('success', 'تم إنشاء الحجز بنجاح!');
    }

    public function show($id)
    {
        $booking = Booking::where('client_id', Auth::id())
            ->with(['service', 'technician', 'review'])
            ->findOrFail($id);

        return view('client.bookings.show', compact('booking'));
    }
}
