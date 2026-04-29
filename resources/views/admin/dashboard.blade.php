<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin — ShelterGym</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-sm text-red-500 hover:underline">Logout</button>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow p-5 text-center">
            <p class="text-gray-500 text-sm">Member Aktif</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $data['totalMember'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5 text-center">
            <p class="text-gray-500 text-sm">Tidak Aktif</p>
            <p class="text-3xl font-bold text-red-500 mt-1">{{ $data['totalMemberTidakAktif'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5 text-center">
            <p class="text-gray-500 text-sm">Kunjungan Hari Ini</p>
            <p class="text-3xl font-bold text-green-600 mt-1">{{ $data['kunjunganHariIni'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5 text-center">
            <p class="text-gray-500 text-sm">Pendapatan Hari Ini</p>
            <p class="text-xl font-bold text-yellow-600 mt-1">Rp {{ number_format($data['pendapatanHariIni'], 0, ',', '.') }}</p>
        </div>
    </div>
</div>

</body>
</html>