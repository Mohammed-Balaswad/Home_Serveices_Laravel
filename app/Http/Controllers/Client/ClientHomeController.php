<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
use App\Models\Service;
use App\Models\Review;

class ClientHomeController extends Controller
{
    public function index()
    {
        $client = Auth::user();

        // أفضل الفنيين
        $topTechnicians = User::where('role', 'technician')
            ->orderByDesc('rating_avg')
            ->take(6)
            ->get();

        // الفئات
        $categories = Category::orderBy('name')->get();

        // الخدمات الأكثر طلبًا (مُصلحة بدون عمود popularity)
        $popularServices = Service::with('category')
    ->withCount('bookings')
    ->orderByDesc('bookings_count')
    ->take(8)
    ->get();




        return view('client.home', compact(
            'client',
            'topTechnicians',
            'categories',
            'popularServices',
            
        ));
    }
}
