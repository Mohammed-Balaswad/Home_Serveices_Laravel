<x-layouts.technician>
    <x-slot:heading>حجوزاتي</x-slot:heading>

    <h1 class="text-2xl font-bold mb-6">إدارة الحجوزات</h1>

    {{-- فلترة --}}
    <div class="mb-6">
        <form class="flex flex-wrap gap-3 items-center" method="GET">
            <select name="status" class="border pr-10 px-3 py-2 rounded">
                <option value="">الحالة</option>
                <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>معلقة</option>
                <option value="accepted" {{ request('status')=='accepted' ? 'selected' : '' }}>مقبولة</option>
                <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>مكتملة</option>
                <option value="rejected" {{ request('status')=='rejected' ? 'selected' : '' }}>مرفوضة</option>
                <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>ملغاة</option>
            </select>

            <input type="date" name="date" value="{{ request('date') }}" class="border px-3 py-2 rounded">
            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">بحث</button>
        </form>
    </div>

    {{-- قائمة الحجوزات --}}
    <div class="space-y-4">
    @forelse ($bookings as $booking)
        <div class="bg-white p-5 rounded-lg shadow flex justify-between items-center">
            <div>
                <div class="font-bold text-lg text-gray-800">
                    {{ $booking->service->name }} — {{ $booking->client->name }}
                </div>
                <div class="text-sm text-gray-500 mt-1">
                    {{ $booking->date }} {{ $booking->time }}
                </div>
                <div class="text-sm mt-1">
                    الحالة:
                    <span class="
                        @if($booking->status === 'pending') text-yellow-600
                        @elseif($booking->status === 'accepted') text-green-600
                        @elseif($booking->status === 'completed') text-blue-600
                        @elseif($booking->status === 'rejected') text-red-600
                        @elseif($booking->status === 'cancelled') text-gray-600
                        @endif
                    ">
                        {{ $booking->status }}
                    </span>
                </div>
                <div class="text-sm text-gray-700 mt-1">
                    السعر: {{ $booking->agreed_price ?? '—' }} ر.ي
                </div>
            </div>

            <div class="flex items-center gap-2">
            <a href="{{ route('technician.bookings.show', $booking->id) }}"
                               class="text-white bg-blue-700 px-3 py-1 rounded hover:bg-blue-800">
                                <i class="fa-solid fa-eye"></i> تفاصيل
                            </a>

                {{-- أزرار الحالة حسب المنطق --}}
                @if($booking->status === 'pending')
                    <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST" class="flex gap-2 items-center">
                        @csrf
                        <input type="hidden" name="status" value="accepted">
                        <input type="number" name="agreed_price" placeholder="السعر المتفق" class="border px-2 py-1 rounded w-36" required>
                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition">
                            قبول
                        </button>
                    </form>

                    <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                            رفض
                        </button>
                    </form>
                @elseif($booking->status === 'accepted')
                    <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                            مكتمل
                        </button>
                    </form>

                    <form action="{{ route('technician.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 transition">
                            إلغاء
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
            لا توجد حجوزات حالياً
        </div>
    @endforelse
</div>

    {{-- روابط الصفحات --}}
    <div class="mt-6">
        {{ $bookings->links() }}
    </div>
</x-layouts.technician>