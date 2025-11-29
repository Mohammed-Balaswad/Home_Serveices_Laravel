<x-layouts.technician>
    <x-slot:heading>
        لوحة التحكم - الفني
    </x-slot:heading>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">

        {{-- الحجوزات --}}
        <div class="bg-blue-100 p-6 rounded-lg shadow">
            <div class="text-4xl font-bold text-blue-700">{{ $bookingsCount }}</div>
            <div class="mt-2 text-gray-700">إجمالي الحجوزات</div>
        </div>

        {{-- الخدمات --}}
        <div class="bg-green-100 p-6 rounded-lg shadow">
            <div class="text-4xl font-bold text-green-700">{{ $servicesCount }}</div>
            <div class="mt-2 text-gray-700">الخدمات التي تقدمها</div>
        </div>

        {{-- التقييمات --}}
        <div class="bg-yellow-100 p-6 rounded-lg shadow">
            <div class="text-4xl font-bold text-yellow-700">
                {{ $averageRating ? number_format($averageRating, 1) : 0 }}
            </div>
            <div class="mt-2 text-gray-700">متوسط التقييمات</div>
        </div>

    </div>
    </x-layouts.technician>


