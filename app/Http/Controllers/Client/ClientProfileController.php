<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    public function edit()
    {
        return view('client.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $client = User::findOrFail(Auth::id());;

        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'location' => 'nullable|string',
        ]);

        $client->update($request->only(['name','phone','location']));

        return back()->with('success', 'تم تحديث الحساب بنجاح');
    }
}
