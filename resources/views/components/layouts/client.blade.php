<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'منصة الخدمات' }}</title>

    @vite('resources/css/app.css')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    {{-- Top Navigation --}}
    <nav class="bg-white shadow-sm fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

            {{-- Logo --}}
            <a href="{{ route('client.home') }}" class="flex items-center gap-2 text-xl font-bold text-blue-700">
                <i class="fa-solid fa-handshake"></i>
                خدماتي
            </a>

            {{-- Menu Right --}}
            <div class="flex items-center gap-6">

                {{-- Orders --}}
                <a href="{{ route('client.bookings.index') }}"
                   class="text-gray-700 hover:text-blue-700 text-sm">
                    <i class="fa-solid fa-calendar-check mr-1"></i>
                    طلباتي
                </a>

                {{-- Services --}}
                <a href="{{ route('client.services') }}"
                   class="text-gray-700 hover:text-blue-700 text-sm">
                    <i class="fa-solid fa-wrench mr-1"></i>
                    الخدمات
                </a>

                {{-- Profile --}}
                <a href="{{ route('client.profile') }}"
                   class="text-gray-700 hover:text-blue-700 text-sm">
                    <i class="fa-solid fa-user mr-1"></i>
                    حسابي
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg text-sm flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        خروج
                    </button>
                </form>

            </div>

        </div>
    </nav>

    {{-- Page Content --}}
    <main class="pt-24 pb-10">
        <div class="max-w-7xl mx-auto px-6">
            
            {{-- Alerts --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-3 font-semibold">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-3 font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Page Content Slot --}}
            <div class="bg-white p-6 mb-6 shadow rounded-lg">
                {{ $slot }}
            </div>

        </div>
    </main>

</body>
</html>
