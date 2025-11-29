<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TechnicianProfileController extends Controller
{
    public function show()
    {
        $technician = Auth::user();
        return view('technician.profile.show', compact('technician'));
    }

    public function update(Request $request)
{
    $technician = User::findOrFail(Auth::id());

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string|max:500',
        'avatar' => 'nullable|image|max:2048',
    ]);

    $data = $request->only(['name','phone','bio']);

    if ($request->hasFile('avatar')) {
        $data['image'] = $request->file('avatar')->store('avatars','public');
    }

    $technician->update($data);

    return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
}

}