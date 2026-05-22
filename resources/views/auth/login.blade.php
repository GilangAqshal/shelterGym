<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="w-6 h-6 rounded-full" rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title x-data x-text="$store.authPage?.isRegister ? 'Register | ShelterGym' : 'Login | ShelterGym'">ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        /* Animasi mengapung untuk elemen dekoratif */
        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-20px) scale(1.03); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0) scale(1.03); }
            50% { transform: translateY(25px) scale(0.97); }
        }
        .animate-float-slow { animation: float 8s ease-in-out infinite; }
        .animate-float-reverse { animation: floatReverse 10s ease-in-out infinite; }
        .animate-float-fast { animation: float 6s ease-in-out infinite; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body x-data="{ 
        isRegister: {{ $startWithRegister ? 'true' : 'false' }},
        switchPage(toRegister) {
            this.isRegister = toRegister;
            const newUrl = toRegister ? '{{ route('register') }}' : '{{ route('login') }}';
            window.history.pushState({ path: newUrl }, '', newUrl);
        }
     }"
     class="bg-gradient-to-br from-blue-600 via-white to-white min-h-screen flex items-center justify-center p-4 md:p-6 font-sans overflow-x-hidden relative">

    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none md:hidden">
        <div class="absolute top-[10%] left-[5%] w-72 h-72 bg-blue-600 rounded-full blur-[100px] opacity-40 animate-float-slow"></div>
        <div class="absolute bottom-[10%] right-[5%] w-80 h-80 bg-cyan-500 rounded-full blur-[120px] opacity-30 animate-float-reverse"></div>
        <div class="absolute top-[40%] right-[20%] w-64 h-64 bg-indigo-500 rounded-full blur-[90px] opacity-25 animate-float-slow"></div>
    </div>

    <div class="w-full max-w-md md:max-w-6xl min-h-[600px] md:min-h-[680px] bg-white/10 dark:bg-slate-900/40 backdrop-blur-xl md:backdrop-blur-none md:bg-gradient-to-tr md:from-slate-50 md:to-white rounded-2xl md:rounded-3xl shadow-2xl flex flex-col md:flex-row relative overflow-hidden border border-white/20 md:border-none z-10">
        
        <div class="hidden md:flex w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 text-white p-12 flex-col justify-center relative overflow-hidden transition-all duration-700 ease-in-out z-20 md:absolute md:top-0 md:bottom-0 md:left-0 md:h-full"
             :class="isRegister ? 'md:translate-x-full rounded-r-none md:rounded-l-none' : 'md:translate-x-0 rounded-l-none md:rounded-r-none'">
            
            <div class="absolute -top-10 w-72 h-72 rounded-full bg-gradient-to-tr from-blue-500 to-cyan-400 opacity-60 filter blur-sm shadow-inner transition-all duration-700 ease-in-out animate-float-slow"
                 :class="isRegister ? '-right-10' : '-left-10'"></div>
            <div class="absolute -bottom-20 w-96 h-96 rounded-full bg-gradient-to-br from-blue-700 to-indigo-900 opacity-80 shadow-2xl transition-all duration-700 ease-in-out animate-float-reverse"
                 :class="isRegister ? '-right-20' : '-left-20'"></div>
            <div class="absolute bottom-10 w-52 h-52 rounded-full bg-gradient-to-tr from-blue-400 to-blue-600 opacity-90 shadow-xl transition-all duration-700 ease-in-out animate-float-fast"
                 :class="isRegister ? 'right-10' : 'left-10'"></div>
            
            <div class="relative z-10 max-w-md mx-auto text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-4 drop-shadow-md transition-all duration-500"
                    x-text="isRegister ? 'JOIN US!' : 'WELCOME BACK!'"></h2>
                
                <p class="text-lg md:text-xl font-medium tracking-widest text-blue-200 uppercase mb-6">SHELTER GYM</p>
                
                <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 opacity-90 h-24 transition-all duration-500"
                   x-text="isRegister ? 'Daftarkan diri Anda hari ini untuk mendapatkan akses penuh ke fasilitas fitness modern, program latihan terstruktur, dan komunitas olahraga terbaik.' : 'Senang melihat Anda kembali. Masuk ke akun Anda untuk melanjutkan pelacakan keanggotaan, jadwal latihan, dan memantau perkembangan kebugaran Anda.'">
                </p>

                <button type="button" @click="switchPage(!isRegister)" 
                        class="inline-block border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white hover:text-blue-700 transition duration-300 transform active:scale-95 shadow-md text-center cursor-pointer">
                    <span x-text="isRegister ? 'Sudah Punya Akun? Login' : 'Belum Punya Akun? Daftar'"></span>
                </button>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-2 md:p-16 flex flex-col justify-center md:absolute md:top-0 md:bottom-0 md:right-0 md:h-full transition-all duration-500 ease-in-out"
             :class="isRegister ? 'opacity-0 scale-95 pointer-events-none z-0 hidden md:flex' : 'opacity-100 scale-100 z-10 block'">
            
            <div class="w-full mx-auto">
                <a href="/" class="inline-flex items-center text-sm text-gray-300 md:text-gray-400 transition-colors hover:text-white md:hover:text-gray-600 mb-6">
                    <svg class="stroke-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M12.7083 5L7.5 10.2083L12.7083 15.4167" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

                <div class="text-center md:text-left mb-8">
                    <h1 class="flex items-center justify-center md:justify-start gap-2 text-3xl font-extrabold text-white md:text-gray-900">
                        <img src="/images/logo/logo_icon.png" alt="ShelterGym" class="w-9 h-9">
                        Sign in
                    </h1>
                    <p class="text-gray-300 md:text-gray-400 mt-1 text-sm">Masuk ke akun kamu</p>
                </div>

                @if ($errors->any() && !$startWithRegister)
                    <div class="bg-red-500/20 md:bg-red-50 border border-red-500/40 md:border-red-200 text-red-200 md:text-red-600 rounded-lg px-4 py-3 mb-5 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    @if(session('success_register'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="bg-green-500/20 md:bg-green-50 border border-green-500/30 md:border-green-200 text-green-300 md:text-green-600 rounded-xl px-4 py-3 mb-5 text-sm">
                        ✅ {{ session('success_register') }}
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-semibold text-gray-200 md:text-gray-700 mb-1.5">Email</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="email@example.com"
                                class="w-full bg-white/5 md:bg-gray-50/50 border border-white/10 md:border-gray-200 rounded-xl px-4 py-2.5 pl-10 text-sm text-white md:text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-200 md:text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </span>
                            <input type="password" name="password" id="inputPassword" required placeholder="password"
                                class="w-full bg-white/5 md:bg-gray-50/50 border border-white/10 md:border-gray-200 rounded-xl px-4 py-2.5 pl-10 pr-10 text-sm text-white md:text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            
                            <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white md:hover:text-gray-600 focus:outline-none">
                                <svg id="eyeIcon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path id="eyePath" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path id="eyeBack" stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2 text-gray-300 md:text-gray-600 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="rounded border-white/20 md:border-gray-300 bg-white/5 md:bg-white text-blue-600 focus:ring-blue-500"> Ingat saya
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 md:hover:bg-blue-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-blue-600/20 transition-all active:scale-[0.98]">
                        Masuk
                    </button>
                </form>

                <p class="text-center text-sm text-gray-300 md:hidden mt-6">
                    Belum punya akun?
                    <button type="button" @click="switchPage(true)" class="text-blue-400 hover:underline font-medium focus:outline-none">
                        Daftar di sini
                    </button>
                </p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-2 md:p-12 flex flex-col justify-center md:absolute md:top-0 md:bottom-0 md:left-0 md:h-full transition-all duration-500 ease-in-out"
             :class="isRegister ? 'opacity-100 scale-100 z-10 block' : 'opacity-0 scale-95 pointer-events-none z-0 hidden md:flex'">
            
            <div class="w-full mx-auto max-h-[80vh] md:max-h-[90vh] overflow-y-auto no-scrollbar pr-1">
                <p class="text-center text-gray-200 text-sm mt-1 mb-5 font-bold tracking-wide uppercase md:hidden">Buat akun baru</p>
                <div class="hidden md:block mb-6">
                    <h1 class="text-3xl font-extrabold text-gray-900">Sign up</h1>
                    <p class="text-gray-400 mt-1 text-sm">Buat akun baru ShelterGym</p>
                </div>

                @if ($errors->any() && $startWithRegister)
                <div class="bg-red-500/20 md:bg-red-50 border border-red-500/30 md:border-red-200 text-red-200 md:text-red-600 rounded-xl px-4 py-3 mb-5 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap"
                                class="w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com"
                                class="w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password" required placeholder="Min. 6 karakter"
                                class="w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                                class="w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="noTelp" value="{{ old('noTelp') }}" placeholder="08xxxxxxxxxx"
                                class="w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Jenis Kelamin</label>
                            <select name="jenisKelamin" class="w-full bg-slate-900 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <option value="" class="text-gray-400">-- Pilih --</option>
                                <option value="Laki-laki" {{ old('jenisKelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenisKelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="text" name="tanggalLahir" value="{{ old('tanggalLahir') }}"
                            class="datepicker w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Pilih tanggal lahir">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-200 md:text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" rows="2" placeholder="Alamat lengkap"
                            class="w-full bg-white/5 md:bg-white border border-white/10 md:border-gray-300 rounded-xl px-4 py-2.5 md:py-2 text-sm text-white md:text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('alamat') }}</textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 md:hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition text-sm mt-2 shadow-lg shadow-blue-600/10">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="text-center text-sm text-gray-300 md:hidden mt-5">
                    Sudah punya akun?
                    <button type="button" @click="switchPage(false)" class="text-blue-400 hover:underline font-medium focus:outline-none">
                        Login di sini
                    </button>
                </p>
            </div>
        </div>

    </div>

    <p class="absolute bottom-2 text-center text-xs text-gray-500 md:hidden z-10">
        © {{ date('Y') }} ShelterGym. All rights reserved.
    </p>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('inputPassword');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.add('text-blue-400');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('text-blue-400');
        }
    }
</script>
</body>
</html>