<x-layouts.technician>
    <x-slot:heading>تفاصيل الحجز</x-slot:heading>

    <h1 class="text-2xl font-bold mb-6">تفاصيل الحجز #{{ $booking->id }}</h1>
    <div class="bg-white rounded-xl shadow-lg p-8 space-y-6">

        {{-- معلومات الخدمة والعميل --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-bold text-blue-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-wrench"></i> الخدمة
                </h3>
                <p class="text-gray-800 font-semibold mb-4">{{ $booking->service->name }}</p>
                <p class="text-gray-600 mt-2"><span class="font-bold text-gray-700">الوصف: </span>{{ $booking->service->description }}</p>
                <p class="text-sm text-gray-500 mt-1"><span class="font-bold text-gray-700">السعر الأساسي:  </span>{{ $booking->service->base_price }} $</p>
            </div>

            <div class="p-6 bg-green-50 rounded-lg">
                <h3 class="text-lg font-bold text-green-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-user"></i> العميل
                </h3>
                <p class="text-gray-800 font-semibold">
                    <i class="fa-solid fa-user text-blue-600 mr-2"></i> {{ $booking->client->name }}
                </p>

                <p class="text-gray-600 mt-2">
                    <i class="fa-solid fa-envelope text-indigo-600 mr-2"></i> {{ $booking->client->email }}
                </p>

                <p class="text-gray-600">
                    <i class="fa-solid fa-phone text-green-600 mr-2"></i> {{ $booking->client->phone }}
                </p>

                <p class="text-gray-600">
                    <i class="fa-solid fa-location-dot text-red-600 mr-2"></i> {{ $booking->client->location }}
                </p>
            </div>
        </div>

        {{-- تفاصيل الحجز --}}
        <div class="p-6 bg-yellow-50 rounded-lg">
            <h3 class="text-lg font-bold text-yellow-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check"></i> تفاصيل الحجز
            </h3>
            <p class="text-gray-800">
                <i class="fa-solid fa-calendar-day text-blue-600 mr-2"></i> التاريخ: {{ $booking->date }}
            </p>

            <p class="text-gray-800">
                <i class="fa-solid fa-clock text-indigo-600 mr-2"></i> الوقت: {{ $booking->time }}
            </p>

            <p class="text-gray-800">
                <i class="fa-solid fa-money-bill-wave text-green-600 mr-2"></i> السعر المتفق: {{ $booking->agreed_price ?? '—' }} ر.ي
            </p>
            <p class="text-gray-800">
                الحالة:
                <span class="
                    @if($booking->status === 'pending') text-yellow-600
                    @elseif($booking->status === 'accepted') text-green-600
                    @elseif($booking->status === 'completed') text-blue-600
                    @elseif($booking->status === 'rejected') text-red-600
                    @elseif($booking->status === 'cancelled') text-gray-600
                    @endif
                font-bold">
                    {{ $booking->status }}
                </span>
            </p>
        </div>

        {{-- التقييمات --}}
        @if($booking->review)
            <div class="p-6 bg-purple-50 rounded-lg">
                <h3 class="text-lg font-bold text-purple-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-star"></i> تقييم العميل
                </h3>
                <p class="text-yellow-600 text-xl font-bold">
                     {{ $booking->review->rating }}/5
                </p>
                <p class="text-gray-700 mt-2">{{ $booking->review->comment }}</p>
            </div>
        @endif

        {{-- أزرار التحكم --}}
        <div class="flex gap-3">
            @if($booking->status === 'pending')
                <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST" class="flex gap-2 items-center">
                    @csrf
                    <input type="hidden" name="status" value="accepted">
                    <input type="number" name="agreed_price" placeholder="السعر المتفق" class="border px-2 py-1 rounded w-32" required>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        قبول
                    </button>
                </form>

                <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        رفض
                    </button>
                </form>
            @elseif($booking->status === 'accepted')
                <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        مكتمل
                    </button>
                </form>

                <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                        إلغاء
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-layouts.technician>