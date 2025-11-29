<x-layouts.technician>
    <x-slot:heading>تقييماتي</x-slot:heading>

    <div class="space-y-4">
        @forelse ($reviews as $review)
            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-star text-yellow-500"></i>
                            {{ $review->booking->client->name ?? 'عميل مجهول' }}
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">
                            الخدمة: {{ $review->booking->service->name ?? '—' }}
                        </p>
                    </div>
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                </div>

                <p class="text-gray-700 mt-3">{{ $review->comment }}</p>

                <p class="text-xs text-gray-500 mt-2">
                    بتاريخ: {{ $review->created_at->format('Y-m-d H:i') }}
                </p>
            </div>
        @empty
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded">
                لا توجد تقييمات حالياً
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>
</x-layouts.technician>