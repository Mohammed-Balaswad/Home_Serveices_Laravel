<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
        {{-- العنوان --}}
        <h2 class="text-3xl font-bold text-center mb-6 text-blue-700">
            تسجيل الدخول
        </h2>

        {{-- الفورم --}}
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-1 text-gray-700 font-medium">البريد الإلكتروني</label>
                <input type="email" name="email"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       placeholder="example@email.com" required>
            </div>

            <div>
                <label class="block mb-1 text-gray-700 font-medium">كلمة المرور</label>
                <input type="password" name="password"
                       class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                       placeholder="••••••••" required>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow-md transition transform hover:scale-105">
                دخول
            </button>

            <p class="mt-4 text-center text-sm text-gray-600">
                ليس لديك حساب؟
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                    إنشاء حساب جديد
                </a>
            </p>
        </form>
    </div>

</body>
</html>