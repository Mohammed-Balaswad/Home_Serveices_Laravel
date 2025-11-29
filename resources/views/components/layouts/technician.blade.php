<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم - الفني</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    {{-- Sidebar --}}
    <aside class="fixed top-0 right-0 h-screen w-64 bg-blue-900 text-white p-6">
        <h2 class="text-lg font-bold flex items-center gap-2 mb-8">
            <i class="fa-solid fa-user-tie"></i> الفني
        </h2>

        <nav class="flex flex-col gap-2">

            {{-- Dashboard --}}
            <x-nav-link href="{{ route('technician.dashboard') }}" 
                        :active="request()->routeIs('technician.dashboard')">
                <i class="fa-solid fa-chart-line mr-2"></i> لوحة التحكم
            </x-nav-link>

            {{-- My Bookings --}}
            <x-nav-link href="{{ route('technician.bookings.index') }}" 
                        :active="request()->routeIs('technician.bookings.*')">
                <i class="fa-solid fa-calendar-check mr-2"></i> الحجوزات
            </x-nav-link>

            {{-- My Services --}}
            <x-nav-link href="{{ route('technician.services.index') }}" 
                        :active="request()->routeIs('technician.services.*')">
                <i class="fa-solid fa-wrench mr-2"></i> الخدمات الخاصة بي
            </x-nav-link>

            {{-- My Schedule --}}
            <x-nav-link href="{{ route('technician.schedule.index') }}" 
                        :active="request()->routeIs('technician.schedule.*')">
                <i class="fa-solid fa-clock mr-2"></i> جدول المواعيد
            </x-nav-link>

            {{-- Reviews --}}
            <x-nav-link href="{{ route('technician.reviews.index') }}" 
                        :active="request()->routeIs('technician.reviews.*')">
                <i class="fa-solid fa-star mr-2"></i> التقييمات
            </x-nav-link>

            {{-- Profile --}}
            <x-nav-link href="{{ route('technician.profile.show') }}" 
                        :active="request()->routeIs('technician.profile.*')">
                <i class="fa-solid fa-user mr-2"></i> الملف الشخصي
            </x-nav-link>

        </nav>
    </aside>

    {{-- Main --}}
    <main class="ml-0 mr-64 p-6">

        {{-- Header --}}

        @if ($errors->has('access'))
    <div class="bg-red-600 border border-red-600 text-white mb-5 px-4 py-3 rounded-lg text-center">
        <p>{{ $errors->first('access') }}</p>
    </div>
@endif

        <header class="bg-white shadow rounded-lg p-4 flex justify-between items-center mb-6">
            <div class="font-semibold text-gray-700">
                مرحبًا، {{ Auth::user()->name }}
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i> تسجيل خروج
                </button>
            </form>
        </header>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 font-bold">
                {{ session('error') }}
            </div>
        @endif

        {{-- Content slot --}}
        <section class="bg-white rounded-lg shadow p-6">
            {{ $slot }}
        </section>
    </main>

</body>
</html>
