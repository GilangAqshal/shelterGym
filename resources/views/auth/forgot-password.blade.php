<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Lupa Password | ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.03); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0) scale(1.03); }
            50% { transform: translateY(25px) scale(0.97); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-float-slow    { animation: float 8s ease-in-out infinite; }
        .animate-float-reverse { animation: floatReverse 10s ease-in-out infinite; }
        .animate-float-fast    { animation: float 6s ease-in-out infinite; }
        .animate-slide-up      { animation: slideUp 0.5s ease-out forwards; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-600 via-white to-white min-h-screen flex items-center justify-center p-4 md:p-6 font-sans overflow-x-hidden relative">

    {{-- Background blobs mobile --}}
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none md:hidden">
        <div class="absolute top-[10%] left-[5%] w-72 h-72 bg-blue-600 rounded-full blur-[100px] opacity-40 animate-float-slow"></div>
        <div class="absolute bottom-[10%] right-[5%] w-80 h-80 bg-cyan-500 rounded-full blur-[120px] opacity-30 animate-float-reverse"></div>
    </div>

    <div class="w-full max-w-md md:max-w-6xl md:min-h-[580px] bg-white/10 md:bg-gradient-to-tr md:from-slate-50 md:to-white backdrop-blur-xl md:backdrop-blur-none rounded-2xl md:rounded-3xl shadow-2xl flex flex-col md:flex-row relative overflow-hidden border border-white/20 md:border-none z-10">

        {{-- Panel Kiri (Dekorasi) --}}
        <div class="hidden md:flex w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 text-white p-12 flex-col justify-center relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-72 h-72 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 opacity-60 filter blur-sm animate-float-slow"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full bg-gradient-to-br from-blue-700 to-indigo-900 opacity-80 animate-float-reverse"></div>
            <div class="absolute bottom-10 left-10 w-52 h-52 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 opacity-90 animate-float-fast"></div>

            <div class="relative z-10 max-w-md mx-auto">
                <div class="text-6xl mb-6">🔐</div>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-4 drop-shadow-md">LUPA<br>PASSWORD?</h2>
                <p class="text-lg font-medium tracking-widest text-blue-200 uppercase mb-6">SHELTER GYM</p>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 opacity-90">
                    Tenang! Masukkan email yang terdaftar dan kami akan kirimkan link untuk mereset password kamu.
                </p>
                <a href="{{ route('login') }}"
                    class="inline-block border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white hover:text-blue-700 transition duration-300 active:scale-95">
                    Kembali ke Login
                </a>
            </div>
        </div>

        {{-- Panel Kanan (Form) --}}
        <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center transform transition-all duration-700 ease-out translate-y-4 opacity-0" 
            x-data="{ mounted: false }" 
            x-init="setTimeout(() => mounted = true, 100)" 
            :class="{ 'translate-y-0 opacity-100': mounted }">
            <div class="w-full max-w-md mx-auto">

                {{-- Back button mobile --}}
                <a href="{{ route('login') }}"
                    class="inline-flex items-center text-sm text-gray-300 md:text-gray-400 hover:text-white md:hover:text-gray-600 mb-6 transition">
                    <svg class="stroke-current mr-1" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M12.7083 5L7.5 10.2083L12.7083 15.4167" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali ke Login
                </a>

                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="/images/logo/logo_icon.png" alt="ShelterGym" class="w-9 h-9">
                        <h1 class="text-3xl font-extrabold text-white md:text-gray-900">Lupa Password</h1>
                    </div>
                    <p class="text-gray-300 md:text-gray-400 text-sm">
                        Masukkan email kamu dan kami akan kirim link reset password.
                    </p>
                </div>

                {{-- Alert Sukses --}}
                @if(session('success'))
                <div x-data="{ show: true }" x-show="show"
                    class="animate-slide-up bg-green-500/20 md:bg-green-50 border border-green-500/40 md:border-green-200 text-green-300 md:text-green-700 rounded-xl px-4 py-4 mb-6 text-sm">
                    <div class="flex items-start gap-3">
                        {{-- <span class="text-xl shrink-0">✅</span> --}}
                        <div>
                            <p class="font-semibold mb-1">Email Terkirim!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Alert Error --}}
                @if($errors->any())
                <div class="bg-red-500/20 md:bg-red-50 border border-red-500/40 md:border-red-200 text-red-300 md:text-red-600 rounded-xl px-4 py-3 mb-5 text-sm">
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-200 md:text-gray-700 mb-1.5">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                autofocus placeholder="email@example.com"
                                class="w-full bg-white/5 md:bg-gray-50/50 border border-white/10 md:border-gray-200 rounded-xl px-4 py-3 pl-10 text-sm text-white md:text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-500 md:hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98]">
                        Kirim Link Reset Password
                    </button>
                </form>

                <p class="text-center text-sm text-gray-300 md:text-gray-500 mt-6">
                    Ingat password kamu?
                    <a href="{{ route('login') }}" class="text-blue-400 md:text-blue-600 hover:underline font-medium">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>

    </div>

    <p class="absolute bottom-2 text-center text-xs text-gray-400 z-10">
        © {{ date('Y') }} ShelterGym. All rights reserved.
    </p>

</body>
</html>