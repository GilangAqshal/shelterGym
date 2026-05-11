@extends('layouts.app')
{{-- @extends('layouts.appu') --}}

@section('content')
<x-common.page-breadcrumb pageTitle="Dashboard" />


{{-- Greeting --}}
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
        Halo, {{ $user->name }}! 👋
    </h2>
    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
    </p>
</div>

{{-- ── Baris 1: Status Cards ── --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-6">

    {{-- Status Membership --}}
    <div class="rounded-2xl border p-5
        {{ $member && $member->statusMember === 'aktif'
            ? 'border-green-200 bg-green-50 dark:border-green-500/20 dark:bg-green-500/10'
            : 'border-red-200 bg-red-50 dark:border-red-500/20 dark:bg-red-500/10' }}">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium
                {{ $member && $member->statusMember === 'aktif'
                    ? 'text-green-700 dark:text-green-400'
                    : 'text-red-600 dark:text-red-400' }}">
                Status Membership
            </p>
            <span class="text-2xl">
                {{ $member && $member->statusMember === 'aktif' ? '✅' : '❌' }}
            </span>
        </div>
        <p class="text-xl font-bold
            {{ $member && $member->statusMember === 'aktif'
                ? 'text-green-700 dark:text-green-300'
                : 'text-red-600 dark:text-red-300' }}">
            {{ $member && $member->statusMember === 'aktif' ? 'Aktif' : 'Tidak Aktif' }}
        </p>
        <p class="text-xs mt-2
            {{ $member && $member->statusMember === 'aktif'
                ? 'text-green-600 dark:text-green-400'
                : 'text-red-500 dark:text-red-400' }}">
            {{ $member ? $member->paket->namaPaket ?? '-' : 'Belum terdaftar' }}
        </p>
    </div>

    {{-- Sisa Hari --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-gray-500 dark:text-gray-400">Sisa Hari</p>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl
                {{ $sisaHari !== null && $sisaHari <= 7 ? 'bg-red-50 dark:bg-red-500/10' : 'bg-blue-50 dark:bg-blue-500/10' }}">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="{{ $sisaHari !== null && $sisaHari <= 7 ? '#ef4444' : '#3b82f6' }}"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </span>
        </div>
        @if($member && $member->statusMember === 'aktif' && $sisaHari !== null)
            <p class="text-3xl font-bold {{ $sisaHari <= 7 ? 'text-red-500' : 'text-blue-600 dark:text-blue-400' }}">
                {{ $sisaHari }} hari
            </p>
            <p class="text-xs text-gray-400 mt-2">
                s/d {{ \Carbon\Carbon::parse($member->tanggalAkhir)->translatedFormat('d F Y') }}
            </p>
            @if($sisaHari <= 7)
            <p class="text-xs text-red-500 mt-1 font-medium">⚠️ Segera perpanjang!</p>
            @endif
        @else
            <p class="text-2xl font-bold text-gray-400">—</p>
            <p class="text-xs text-gray-400 mt-2">Tidak ada membership aktif</p>
        @endif
    </div>

    {{-- Kunjungan Bulan Ini --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm text-gray-500 dark:text-gray-400">Kunjungan Bulan Ini</p>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-500/10">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="#a855f7" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $kunjunganBulanIni }}</p>
        <p class="text-xs text-gray-400 mt-2">
            {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
        </p>
    </div>

</div>

{{-- ── Baris 2: Info Member + Kode ── --}}
@if($member)
<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] mb-6">
    <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-4">🪪 Kartu Member</h3>
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div>
            <p class="text-xs text-gray-400 mb-1">Kode Member</p>
            <p class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $member->kodeMember }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-400 mb-1">No. Pendaftaran</p>
            <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $member->noPendaftaran }}</p>
        </div>
        <div>
            <p class="text-xs text-gray-400 mb-1">Tanggal Daftar</p>
            <p class="text-sm font-medium text-gray-800 dark:text-white">
                {{ \Carbon\Carbon::parse($member->tanggalDaftar)->translatedFormat('d F Y') }}
            </p>
        </div>
        <div>
            <p class="text-xs text-gray-400 mb-1">Berlaku s/d</p>
            <p class="text-sm font-medium text-gray-800 dark:text-white">
                {{ \Carbon\Carbon::parse($member->tanggalAkhir)->translatedFormat('d F Y') }}
            </p>
        </div>
    </div>
</div>
@endif

{{-- ── Baris 3: Jadwal Hari Ini + Riwayat ── --}}
<div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

    {{-- Jadwal Latihan Hari Ini --}}
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between px-6 mb-4">
            <div>
                <h3 class="text-base font-semibold text-gray-800 dark:text-white">
                    🏋️ Jadwal Hari Ini
                </h3>
                <p class="text-sm text-gray-400">{{ $hariIni }}</p>
            </div>
            <a href="{{ route('user.jadwal') }}"
                class="text-sm text-blue-600 hover:underline dark:text-blue-400">
                Lihat Semua →
            </a>
        </div>

        @if($jadwalHariIni)
            <div class="px-6 mb-3">
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-50 text-purple-600 dark:bg-purple-500/15 dark:text-purple-400">
                    {{ $jadwalHariIni->fokusLatihan }}
                </span>
            </div>

            <div class="max-w-full px-5 overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-gray-200 border-y dark:border-gray-700">
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Gerakan</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Set & Reps</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Preview</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($jadwalHariIni->gerakan->sortBy('urutan') as $g)
                        <tr>
                            <td class="px-4 py-3">
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $g->namaGerakan }}</p>
                                @if($g->deskripsi)
                                <p class="text-xs text-gray-400 mt-0.5 max-w-xs truncate">{{ $g->deskripsi }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400">
                                    {{ $g->set_reps ?? '-' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <img src="{{ $g->gambar_url }}" alt="{{ $g->namaGerakan }}"
                                    class="w-14 h-14 rounded-lg object-cover" loading="eager">
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-sm text-gray-400">
                                Belum ada gerakan untuk hari ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="px-6 py-12 text-center">
                <p class="text-5xl mb-3">😴</p>
                <p class="text-base font-semibold text-gray-600 dark:text-gray-300">Rest Day!</p>
                <p class="text-sm text-gray-400 mt-1">Tidak ada jadwal latihan hari {{ $hariIni }}.</p>
            </div>
        @endif

        <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
            <p class="text-xs text-gray-400">
                {{ $jadwalHariIni ? $jadwalHariIni->gerakan->count() . ' gerakan terdaftar' : 'Istirahat hari ini' }}
            </p>
        </div>
    </div>

    {{-- Riwayat Kunjungan --}}
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-6 mb-4">
            <h3 class="text-base font-semibold text-gray-800 dark:text-white">📋 Riwayat Kunjungan</h3>
            <p class="text-sm text-gray-400">5 kunjungan terakhir</p>
        </div>

        <div class="max-w-full px-5 overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-gray-200 border-y dark:border-gray-700">
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Invoice</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($riwayatKunjungan as $index => $k)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400">
                                {{ $k->invoice }}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-sm text-gray-400">
                            Belum ada riwayat kunjungan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
            <p class="text-xs text-gray-400">
                Total {{ $riwayatKunjungan->count() }} kunjungan ditampilkan
            </p>
        </div>
    </div>

</div>

@endsection