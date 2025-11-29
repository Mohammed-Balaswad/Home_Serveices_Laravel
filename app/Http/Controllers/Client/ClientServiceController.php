<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;

class ClientServiceController extends Controller
{
    public function index()
    {
        return view('client.services.index', [
            'services' => Service::with('category')->paginate(12)
        ]);
    }

    public function show($id)
    {
        $service = Service::with(['category', 'technicians'])->findOrFail($id);

        return view('client.services.show', compact('service'));
    }
}
