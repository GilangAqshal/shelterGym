<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('logicon.ico') }}">
    <title>Login | ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-8">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-blue-600">🏋️ ShelterGym</h1>
        <p class="text-gray-500 mt-1 text-sm">Masuk ke akunn kamu</p>
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

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="email@example.com" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter password" required>
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center gap-2 text-gray-600">
                <input type="checkbox" name="remember" class="rounded"> Ingat saya
            </label>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg transition">
            Masuk
        </button>
    </form>
</div>

</body>
</html>