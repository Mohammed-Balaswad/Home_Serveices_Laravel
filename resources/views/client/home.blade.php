<x-layouts.client :title="'الرئيسية'">

{{-- Hero Section --}}
<div class="mt-20 bg-gradient-to-l from-blue-50 to-blue-100 rounded-3xl p-10 mb-12 shadow-sm">
    <div class="flex flex-col md:flex-row justify-between items-center gap-10">

        <div class="flex-1">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-snug mb-4">
                كل الخدمات في مكان واحد
            </h1>

            <p class="text-gray-600 text-lg mb-6">
                ابحث عن الفني المناسب واطلب خدمتك بسهولة وسرعة.
            </p>

            {{-- Search --}}
            <form action="{{ route('client.services') }}"
                class="flex bg-white shadow-md rounded-xl overflow-hidden w-full md:w-96 border">

                <input 
                    type="text"
                    name="search"
                    placeholder="ابحث عن خدمة..."
                    class="flex-1 px-4 py-3 text-gray-700 outline-none"
                >

                <button class="px-6 bg-blue-600 text-white font-bold hover:bg-blue-700 transition">
                    بحث
                </button>
            </form>
        </div>

        <img src="/assets/hero-tools.png"
             class="w-64 md:w-72 opacity-95 drop-shadow" />
    </div>
</div>

{{-- Categories --}}
<h2 class="text-xl font-bold text-gray-800 mb-4">الفئات</h2>

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

    @foreach($categories as $category)
        <a href="{{ route('client.services', ['category' => $category->id]) }}"
           class="p-6 bg-white rounded-2xl shadow hover:shadow-lg transition text-center border">

            <div class="flex justify-center mb-4">
                <img src="{{ $category->icon }}" class="w-14 md:w-16 opacity-90">
            </div>

            <p class="font-semibold text-gray-700">
                {{ $category->name }}
            </p>
        </a>
    @endforeach

</div>

{{-- Popular Services --}}
<h2 class="text-xl font-bold text-gray-800 mt-12 mb-4">الخدمات الأكثر طلبًا</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    @foreach($popularServices as $service)
        <a href="{{ route('client.services') }}?service={{ $service->id }}"
           class="block bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition border">

            <img src="{{ $service->image }}"
                 class="w-full h-44 object-cover">

            <div class="p-5">
                <h3 class="font-semibold text-gray-800 text-lg">{{ $service->name }}</h3>
                <p class="text-gray-500 text-sm mt-1">{{ $service->category->name }}</p>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-blue-600 font-bold text-lg">
                        {{ $service->price }} ر.س
                    </span>

                    <span class="text-gray-500 text-sm">
        {{ $service->bookings_count }} طلب
    </span>
                </div>
            </div>
        </a>
    @endforeach

</div>



{{-- Why Choose Us --}}
<div class="mt-16 bg-white rounded-3xl shadow p-12 border">

    <h2 class="text-2xl font-bold text-gray-800 text-center mb-10">
        لماذا تختار خدماتي؟
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">

        <div>
            <i class="fa-solid fa-bolt text-blue-600 text-4xl mb-3"></i>
            <h3 class="font-bold text-gray-800">سرعة في التنفيذ</h3>
            <p class="text-gray-600 mt-2 text-sm">
                فنيون جاهزون لبدء العمل فورًا بعد قبول الطلب.
            </p>
        </div>

        <div>
            <i class="fa-solid fa-shield-halved text-blue-600 text-4xl mb-3"></i>
            <h3 class="font-bold text-gray-800">ثقة واحترافية</h3>
            <p class="text-gray-600 mt-2 text-sm">
                جميع الفنيين موثوقون ومعتمدون بخبرة عالية.
            </p>
        </div>

        <div>
            <i class="fa-solid fa-wallet text-blue-600 text-4xl mb-3"></i>
            <h3 class="font-bold text-gray-800">أسعار شفافة</h3>
            <p class="text-gray-600 mt-2 text-sm">
                أسعار واضحة بدون أي تكاليف خفية أو إضافات.
            </p>
        </div>

    </div>
</div>

{{-- CTA --}}
<div class="mt-16 bg-blue-600 rounded-3xl text-white p-12 text-center shadow-lg">

    <h2 class="text-3xl font-bold mb-4">جاهز تطلب خدمتك؟</h2>

    <p class="text-lg mb-6 opacity-90">
        آلاف الفنيين بانتظار طلبك الآن.
    </p>

    <a href="{{ route('client.services') }}"
       class="px-10 py-3 bg-white text-blue-700 font-extrabold rounded-xl shadow hover:bg-gray-100 transition">
        تصفح الخدمات
    </a>

</div>

</x-layouts.client>
