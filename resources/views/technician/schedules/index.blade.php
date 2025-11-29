<x-layouts.technician>
    <x-slot:heading>جدول المواعيد</x-slot:heading>

    {{-- إضافة موعد جديد --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <form action="{{ route('technician.schedule.store') }}" method="POST" class="flex items-end gap-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">التاريخ</label>
                <input type="date" name="date" class="border px-3 py-2 rounded w-48" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">الوقت</label>
                <input type="time" name="time" class="border px-3 py-2 rounded w-32" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">ربط بحجز</label>
                <select name="booking_id" class="border px-3 py-2 pr-10 rounded w-64">
                    <option value="">بدون حجز</option>
                    @forelse($bookings as $booking)
                        <option value="{{ $booking->id }}">
                            {{ $booking->client->name }} — {{ $booking->service->name }} ({{ $booking->date }} {{ $booking->time }})
                        </option>
                    @empty
                        <option disabled>لا توجد حجوزات حالياً</option>
                    @endforelse
                </select>
            </div>
            <button type="submit" 
                class="bg-green-600 text-white px-3 py-1.5 rounded-md text-sm hover:bg-green-700 transition flex items-center gap-1">
                <i class="fa-solid fa-plus"></i>
                إضافة
            </button>
        </form>
    </div>

    {{-- قائمة المواعيد --}}
    <div class="space-y-4">
        @forelse ($schedules as $schedule)
            <div class="bg-white p-5 rounded-lg shadow flex justify-between items-center">
                <div>
                    <p class="text-gray-800 font-semibold">
                        <i class="fa-solid fa-calendar-day text-blue-600 mr-2"></i>
                        {{ $schedule->date }}
                    </p>
                    <p class="text-gray-800">
                        <i class="fa-solid fa-clock text-indigo-600 mr-2"></i>
                        {{ $schedule->time }}
                    </p>

                    {{-- حالة الموعد --}}
                    <p class="mt-2">
                        <span class="inline-block px-2 py-1 text-xs rounded 
                            {{ $schedule->is_confirmed ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $schedule->is_confirmed ? 'مؤكد' : 'غير مؤكد' }}
                        </span>
                    </p>

                    @if($schedule->booking)
                        <p class="text-gray-700 mt-2">
                            <i class="fa-solid fa-user text-green-600 mr-2"></i>
                            {{ $schedule->booking->client->name }}
                        </p>
                        <p class="text-gray-700">
                            <i class="fa-solid fa-wrench text-orange-600 mr-2"></i>
                            {{ $schedule->booking->service->name }}
                        </p>
                    @else
                        <p class="text-gray-500 mt-2">لا يوجد حجز مرتبط بهذا الموعد</p>
                    @endif
                </div>

                {{-- أزرار التحكم --}}
                <div class="flex gap-2">
                    @if(!$schedule->is_confirmed)
                        <form action="{{ route('technician.schedule.confirm', $schedule->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                                <i class="fa-solid fa-check"></i> تأكيد
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('technician.schedule.destroy', $schedule->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                            <i class="fa-solid fa-trash"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                لا توجد مواعيد حالياً
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $schedules->links() }}
    </div>
</x-layouts.technician>