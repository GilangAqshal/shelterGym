<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link class="w-6 h-6 rounded-full" rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Register | ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-0 md:p-6 font-sans overflow-x-hidden">

<div x-data="{ isRegister: true }" class="bg-white w-full max-w-6xl min-h-[650px] md:rounded-3xl shadow-2xl flex flex-col md:flex-row relative overflow-hidden bg-gradient-to-tr from-slate-50 to-white">
    
    <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 to-blue-800 text-white p-12 flex flex-col justify-center relative overflow-hidden z-20 order-1 md:absolute md:top-0 md:bottom-0 md:left-0 md:h-full md:translate-x-full">
        
        <div class="absolute -top-10 -right-10 w-72 h-72 rounded-full bg-gradient-to-tl from-blue-500 to-cyan-400 opacity-60 filter blur-sm shadow-inner animate-float-slow"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-gradient-to-bl from-blue-700 to-indigo-900 opacity-80 shadow-2xl animate-float-reverse"></div>
        <div class="absolute bottom-10 right-10 w-52 h-52 rounded-full bg-gradient-to-tl from-blue-400 to-blue-600 opacity-90 shadow-xl animate-float-fast"></div>
        
        <div class="relative z-10 max-w-md mx-auto text-center md:text-left">
            <h2 class="text-4xl md:text-5xl font-black tracking-tight mb-4 drop-shadow-md">WELCOME</h2>
            <p class="text-lg md:text-xl font-medium tracking-widest text-blue-200 uppercase mb-6">SHELTER GYM</p>
            <p class="text-blue-100 text-sm md:text-base leading-relaxed mb-8 opacity-90">
                Mulai perjalanan transformasimu bersama kami. Panel latihan modernn, pelacakan keanggotaan, dan komunitas kebugaran terbaik menantimu di sini.
            </p>
            
            <a href="{{ route('login') }}" class="inline-block border-2 border-white text-white font-semibold px-8 py-3 rounded-xl hover:bg-white hover:text-blue-700 transition duration-300 transform active:scale-95 shadow-md text-center cursor-pointer">
                Sudah Punya Akun? Login
            </a>
        </div>
    </div>

    <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center order-3 md:absolute md:top-0 md:bottom-0 md:left-0 md:h-full z-10 opacity-100">
        
        <div class="max-w-md w-full mx-auto max-h-[90vh] overflow-y-auto no-scrollbar pr-1">
            <div class="mb-6">
                <h1 class="text-3xl font-extrabold text-gray-900">Sign up</h1>
                <p class="text-gray-400 mt-1 text-sm">Buat akun baru ShelterGym</p>
            </div>

            @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 rounded-xl px-4 py-3 mb-5 text-sm">
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required placeholder="Min. 6 karakter"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="noTelp" value="{{ old('noTelp') }}" placeholder="08xxxxxxxxxx"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenisKelamin" class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenisKelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenisKelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="text" name="tanggalLahir" value="{{ old('tanggalLahir') }}"
                        class="datepicker w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" placeholder="Pilih tanggal lahir">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="2" placeholder="Alamat lengkap"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm bg-white text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('alamat') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition text-sm mt-2 shadow-lg shadow-blue-600/10">
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    @keyframes float {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-20px) scale(1.03); }
    }
    @keyframes floatReverse {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(25px) scale(0.97); }
    }
    .animate-float-slow { animation: float 8s ease-in-out infinite; }
    .animate-float-reverse { animation: floatReverse 10s ease-in-out infinite; }
    .animate-float-fast { animation: float 6s ease-in-out infinite; }
</style>
</body>
</html>