<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Reset Password | ShelterGym</title>
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

    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none md:hidden">
        <div class="absolute top-[10%] left-[5%] w-72 h-72 bg-blue-600 rounded-full blur-[100px] opacity-40 animate-float-slow"></div>
        <div class="absolute bottom-[10%] right-[5%] w-80 h-80 bg-cyan-500 rounded-full blur-[120px] opacity-30 animate-float-reverse"></div>
    </div>

    <div class="w-full max-w-md md:max-w-6xl md:min-h-[580px] bg-white/10 md:bg-gradient-to-tr md:from-slate-50 md:to-white backdrop-blur-xl md:backdrop-blur-none rounded-2xl md:rounded-3xl shadow-2xl flex flex-col md:flex-row relative overflow-hidden border border-white/20 md:border-none z-10">

        {{-- Panel Kiri --}}
        <div class="hidden md:flex w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 text-white p-12 flex-col justify-center relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-72 h-72 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 opacity-60 filter blur-sm animate-float-slow"></div>
            <div class="absolute -bottom-20 -left-20 w-96 h-96 rounded-full bg-gradient-to-br from-blue-700 to-indigo-900 opacity-80 animate-float-reverse"></div>
            <div class="absolute bottom-10 left-10 w-52 h-52 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 opacity-90 animate-float-fast"></div>

            <div class="relative z-10 max-w-md mx-auto">
                <div class="text-6xl mb-6">🔑</div>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-4 drop-shadow-md">RESET<br>PASSWORD</h2>
                <p class="text-lg font-medium tracking-widest text-blue-200 uppercase mb-6">SHELTER GYM</p>
                <p class="text-blue-100 text-sm md:text-base leading-relaxed opacity-90">
                    Buat password baru yang kuat dan mudah diingat. Pastikan minimal 6 karakter.
                </p>
            </div>
        </div>

        {{-- Panel Kanan (Form) --}}
        <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center animate-slide-up">
            <div class="w-full max-w-md mx-auto">

                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="/images/logo/logo_icon.png" alt="ShelterGym" class="w-9 h-9">
                        <h1 class="text-3xl font-extrabold text-white md:text-gray-900">Password Baru</h1>
                    </div>
                    <p class="text-gray-300 md:text-gray-400 text-sm">
                        Masukkan password baru untuk akun kamu.
                    </p>
                </div>

                @if($errors->any())
                <div class="bg-red-500/20 md:bg-red-50 border border-red-500/40 md:border-red-200 text-red-300 md:text-red-600 rounded-xl px-4 py-3 mb-5 text-sm">
                    {{ $errors->first() }}
                </div>
                @endif

                <form action="{{ route('password.update') }}" method="POST" class="space-y-5"
                    x-data="{ showPass: false, showConfirm: false }">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label class="block text-sm font-semibold text-gray-200 md:text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email', request()->email) }}" required
                                placeholder="email@example.com"
                                class="w-full bg-white/5 md:bg-gray-50/50 border border-white/10 md:border-gray-200 rounded-xl px-4 py-3 pl-10 text-sm text-white md:text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-200 md:text-gray-700 mb-1.5">
                            Password Baru
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input :type="showPass ? 'text' : 'password'" name="password" required
                                placeholder="Min. 6 karakter"
                                class="w-full bg-white/5 md:bg-gray-50/50 border border-white/10 md:border-gray-200 rounded-xl px-4 py-3 pl-10 pr-10 text-sm text-white md:text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <button type="button" @click="showPass = !showPass"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white md:hover:text-gray-600 focus:outline-none">
                                <svg x-show="!showPass" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showPass" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-200 md:text-gray-700 mb-1.5">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </span>
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                                placeholder="Ulangi password baru"
                                class="w-full bg-white/5 md:bg-gray-50/50 border border-white/10 md:border-gray-200 rounded-xl px-4 py-3 pl-10 pr-10 text-sm text-white md:text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white md:hover:text-gray-600 focus:outline-none">
                                <svg x-show="!showConfirm" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showConfirm" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="display:none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-500 md:hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98]">
                        Reset Password
                    </button>
                </form>

                <p class="text-center text-sm text-gray-300 md:text-gray-500 mt-6">
                    Kembali ke
                    <a href="{{ route('login') }}" class="text-blue-400 md:text-blue-600 hover:underline font-medium">
                        halaman login
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