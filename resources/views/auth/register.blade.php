<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        (function() {
            const theme = localStorage.getItem('theme') ||
                (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.body && document.body.classList.add('dark', 'bg-gray-900');
            }
        })();
    </script>
</head>
<body class="min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center p-4">

<div class="w-full max-w-lg">

    {{-- Logo
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-600 mb-4">
            <span class="text-3xl">🏋️</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">ShelterGym</h1>
        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Buat akun baru</p>
    </div> --}}

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-gray-200 dark:border-gray-700">
        <p class="text-center text-bold text-gray-500 dark:text-gray-400 text-sm mt-1 mb-5 font-semibold" >Buat akun baru</p>
        @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 rounded-xl px-4 py-3 mb-5 text-sm">
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
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="Nama lengkap"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="email@example.com"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" required
                        placeholder="Min. 6 karakter"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" required
                        placeholder="Ulangi password"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        No. Telepon
                    </label>
                    <input type="text" name="noTelp" value="{{ old('noTelp') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Jenis Kelamin
                    </label>
                    <select name="jenisKelamin"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenisKelamin') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenisKelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Tanggal Lahir
                </label>
                <input type="text" name="tanggalLahir" value="{{ old('tanggalLahir') }}"
                    class="datepicker w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    placeholder="Pilih tanggal lahir">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                    Alamat
                </label>
                <textarea name="alamat" rows="2" placeholder="Alamat lengkap"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-xl px-4 py-2.5 text-sm bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('alamat') }}</textarea>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl transition text-sm mt-2">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline dark:text-blue-400 font-medium">
                Login di sini
            </a>
        </p>
    </div>

    <p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-6">
        © {{ date('Y') }} ShelterGym. All rights reserved.
    </p>
</div>

</body>
</html>