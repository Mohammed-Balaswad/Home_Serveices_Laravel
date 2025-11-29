<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إنشاء حساب جديد</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
        {{-- العنوان --}}
        <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">
            إنشاء حساب جديد
        </h2>

        {{-- عرض الأخطاء --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 rounded-lg p-4 mb-6 text-sm">
                <ul class="list-disc px-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- الفورم --}}
        <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 text-gray-700 font-medium">الاسم الكامل</label>
                <input type="text" name="name"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
                       placeholder="اكتب اسمك هنا" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">البريد الإلكتروني</label>
                <input type="email" name="email"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
                       placeholder="example@email.com" required>
            </div>

            <div class="relative">
    <label class="block mb-1 text-gray-700 font-medium">كلمة المرور</label>
    <input type="password" name="password" id="password"
           class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
           placeholder="••••••••" required>

    {{-- أيقونة العين --}}
    <span onclick="togglePassword()" class="absolute top-9 left-3 cursor-pointer text-gray-500 hover:text-indigo-600">
        <i id="eyeIcon" class="fa-solid fa-eye"></i>
    </span>
        </div>

        {{-- سكربت التبديل --}}
        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('eyeIcon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            }
        </script>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">رقم الهاتف</label>
                <input type="text" name="phone"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
                       placeholder="7XXXXXXXX" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">المنطقة</label>
                <input type="text" name="location"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600"
                       placeholder="حضرموت – المكلا">
            </div>
       
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold shadow-md transition transform hover:scale-105">
                إنشاء الحساب
            </button>

            <p class="mt-4 text-center text-sm text-gray-600">
                لديك حساب بالفعل؟
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">
                    تسجيل الدخول
                </a>
            </p>
        </form>
    </div>

</body>
</html>