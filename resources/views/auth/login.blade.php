<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Login | ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-8">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <h1 class="flex items-center justify-center gap-2 text-3xl font-bold text-blue-600">
            <img src="/images/logo/logo_icon.png" alt="ShelterGym" class="w-10 h-10">
                ShelterGym
        </h1>
        <p class="text-gray-500 mt-1 text-sm">Masuk ke akun kamu</p>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-600 rounded-lg px-4 py-3 mb-5 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Input Email --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus 
                    placeholder="email@example.com"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            </div>
        </div>

        {{-- Input Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
            <div class="relative">
                <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </span>
                <input type="password" name="password" id="inputPassword" required 
                    placeholder="password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 pl-10 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                
                {{-- Tombol Toggle Password --}}
                <button type="button" onclick="togglePassword()" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <svg id="eyeIcon" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path id="eyePath" stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path id="eyeBack" stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-gray-600 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> Ingat saya
            </label>
            {{-- <a href="#" class="text-blue-600 hover:underline">Lupa password?</a> --}}
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl shadow-md transition-all active:scale-[0.98]">
            Masuk
        </button>
    </form>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('inputPassword');
        const eyeIcon = document.getElementById('eyeIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            // Ubah icon ke "eye-off" (opsional, di sini kita gunakan satu icon dulu agar simpel)
            eyeIcon.classList.add('text-blue-600');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('text-blue-600');
        }
    }
</script>

</body>
</html>