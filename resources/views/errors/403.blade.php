<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Akses Ditolak | ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 dark:bg-gray-900 flex items-center justify-center p-4">
    <div class="text-center max-w-md">
        <div class="mb-6">
            <span class="text-8xl">🚫</span>
        </div>
        <h1 class="text-6xl font-bold text-red-500 mb-2">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-3">
            Akses Ditolak
            
        </h2>
        <p class="text-gray-500 dark:text-gray-400 mb-8">
            Kamu tidak memiliki izin untuk mengakses halaman ini.
        </p>
        <div class="flex gap-3 justify-center">
            <a href="{{ url()->previous() }}"
                class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-800 transition">
                ← Kembali
            </a>
            <a href="{{ auth()->check()
                    ? (in_array(auth()->user()->role, ['owner','admin'])
                        ? route('admin.dashboard')
                        : route('user.dashboard'))
                    : route('login') }}"
                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                Dashboard
            </a>
        </div>
    </div>
</body>
</html>
