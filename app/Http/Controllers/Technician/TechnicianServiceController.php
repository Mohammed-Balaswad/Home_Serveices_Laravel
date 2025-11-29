<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Technician_Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnicianServiceController extends Controller
{
    public function index()
    {
        $technicianId = Auth::id();

        $services = Technician_Service::with('service.category')
            ->where('technician_id', $technicianId)
            ->paginate(10);

        return view('technician.services.index', compact('services'));
    }

    public function update(Request $request, $id)
    {
        $technicianId = Auth::id();

        $service = Technician_Service::where('technician_id', $technicianId)->findOrFail($id);

        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $service->price = $request->price;
        $service->save();

        return back()->with('success', 'تم تحديث السعر بنجاح');
    }
}