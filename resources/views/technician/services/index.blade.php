<x-layouts.technician>
    <x-slot:heading>الخدمات الخاصة بي</x-slot:heading>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 font-bold">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse ($services as $item)
            <div class="bg-white rounded-lg shadow p-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-wrench text-blue-600"></i>
                        {{ $item->service->name }}
                    </h3>
                    <p class="text-gray-600 mt-1">{{ $item->service->description }}</p>
                    <p class="text-sm text-gray-500 mt-1">
                        الفئة: {{ optional($item->service->category)->name ?? '—' }}
                    </p>
                    <p class="text-sm text-gray-700 mt-1">
                        السعر الأساسي: {{ $item->service->base_price }} ر.ي
                    </p>
                    <p class="text-sm text-gray-700 mt-1 font-semibold">
                        سعري الحالي: {{ $item->price }} ر.ي
                    </p>
                </div>

                {{-- تعديل السعر --}}
                <form action="{{ route('technician.services.update', $item->id) }}" method="POST" class="flex gap-2 items-center">
                    @csrf
                    @method('PUT')
                    <input type="number" name="price" value="{{ $item->price }}" class="border px-2 py-1 rounded w-28" required>
                    <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition">
                        <i class="fa-solid fa-pen"></i> تعديل السعر
                    </button>
                </form>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                لا توجد خدمات مرتبطة بك حالياً
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $services->links() }}
    </div>
</x-layouts.technician>