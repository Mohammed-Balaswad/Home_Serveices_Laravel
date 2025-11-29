<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مرحبًا بك في منصتنا</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 font-sans">

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 h-[55vh] flex flex-col items-center justify-center text-center text-white">
        <div class="space-y-4">
            <h1 class="text-4xl md:text-5xl font-bold drop-shadow-lg">
                منصتك الذكية لإدارة الخدمات
            </h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto">
                حلول متكاملة للفنيين والعملاء في حضرموت – المكلا، لتسهيل التواصل وضمان أسعار عادلة
            </p>
        </div>
    </section>

    {{-- About Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center space-y-8">
            <h2 class="text-3xl font-bold text-gray-800">عن منصتنا</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                منصتنا ليست مجرد لوحة تحكم، بل نظام متكامل يلبي احتياجات جميع الأطراف:
                <br>
                <span class="font-semibold text-blue-700">الفني</span> يحصل على فرص عمل منظمة، ويعرض خدماته بشكل احترافي.
                <br>
                <span class="font-semibold text-green-700">العميل</span> يستطيع البحث بسهولة عن الفنيين، التواصل معهم، والحصول على أسعار نزيهة وشفافة.
            </p>

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                <div class="bg-gray-100 rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="text-blue-600 text-4xl mb-4">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">فرص عمل للفنيين</h3>
                    <p class="text-gray-600">منصة منظمة تعرض خدماتك وتربطك بالعملاء المحتاجين لك.</p>
                </div>

                <div class="bg-gray-100 rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="text-green-600 text-4xl mb-4">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">سهولة للعميل</h3>
                    <p class="text-gray-600">ابحث عن الفني المناسب، تواصل معه مباشرة، واحصل على خدمة موثوقة.</p>
                </div>

                <div class="bg-gray-100 rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-4xl mb-4">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">أسعار عادلة</h3>
                    <p class="text-gray-600">نضمن لك شفافية الأسعار وجودة الخدمة في حضرموت – المكلا.</p>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="mt-12">
                <a href="{{ route('login') }}"
                   class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full text-lg font-bold shadow-lg transition transform hover:scale-105">
                    ابدأ الآن
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p class="text-sm">© {{ date('Y') }} منصتنا — جميع الحقوق محفوظة</p>
    </footer>

</body>
</html>