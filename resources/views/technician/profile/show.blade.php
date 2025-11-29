<x-layouts.technician>
    <x-slot:heading>الملف الشخصي</x-slot:heading>


    <div class="bg-white p-6 rounded-lg shadow flex gap-6">
        {{-- صورة الفني --}}
        @if($technician->image)
                <img src="{{ asset('storage/' . $technician->image) }}"
                     alt="{{ $technician->name }}"
                     class="w-20 h-20 rounded-full object-cover border border-gray-300">
            @else
                <div class="w-20 h-20 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 text-3xl font-bold">
                    {{ mb_substr($technician->name, 0, 1) }}
                </div>
            @endif

        {{-- بيانات --}}
        <div class="flex-1">
            <form action="{{ route('technician.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-medium mb-1">الاسم</label>
                    <input type="text" name="name" value="{{ $technician->name }}" 
                           class="border px-3 py-2 rounded w-full">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">رقم الهاتف</label>
                    <input type="text" name="phone" value="{{ $technician->phone }}" 
                           class="border px-3 py-2 rounded w-full">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">نبذة</label>
                    <textarea name="bio" rows="3" class="border px-3 py-2 rounded w-full">{{ $technician->bio }}</textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">الصورة الشخصية</label>
                    <input type="file" name="avatar" class="border px-3 py-2 rounded w-full">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    <i class="fa-solid fa-save"></i> حفظ التغييرات
                </button>
            </form>
        </div>
    </div>
</x-layouts.technician>