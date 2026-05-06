@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Dashboard" />

{{-- ── Baris 1: Stat Cards ── --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-6">

    {{-- Total Member --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-gray-500 dark:text-gray-400">Total Member</span>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="#3b82f6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalMember }}</p>
        <div class="flex gap-2 mt-2">
            <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full dark:bg-green-500/10 dark:text-green-400">
                {{ $totalMemberAktif }} aktif
            </span>
            <span class="text-xs text-red-500 bg-red-50 px-2 py-0.5 rounded-full dark:bg-red-500/10 dark:text-red-400">
                {{ $totalMemberTidakAktif }} tidak aktif
            </span>
        </div>
    </div>

    {{-- Kunjungan Hari Ini --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-gray-500 dark:text-gray-400">Kunjungan Hari Ini</span>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-50 dark:bg-green-500/10">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="#22c55e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalKunjunganHariIni }}</p>
        <div class="flex gap-2 mt-2">
            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full dark:bg-blue-500/10 dark:text-blue-400">
                {{ $kunjunganMemberHariIni }} member
            </span>
            <span class="text-xs text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full dark:bg-purple-500/10 dark:text-purple-400">
                {{ $kunjunganHarianHariIni }} harian
            </span>
        </div>
    </div>

    {{-- Pendapatan Hari Ini --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-gray-500 dark:text-gray-400">Pendapatan Hari Ini</span>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-50 dark:bg-yellow-500/10">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="#eab308" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </span>
        </div>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">
            Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}
        </p>
        <p class="text-xs text-gray-400 mt-2">Dari kunjungan harian</p>
    </div>

    {{-- Member Akan Expired --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm text-gray-500 dark:text-gray-400">Segera Expired</span>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-red-50 dark:bg-red-500/10">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="#ef4444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </span>
        </div>
        <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $memberAkanExpired->count() }}</p>
        <p class="text-xs text-gray-400 mt-2">Member expired dalam 7 hari</p>
    </div>

</div>

{{-- ── Baris 2: Chart + Member Expired ── --}}
<div class="grid grid-cols-1 gap-4 xl:grid-cols-3 mb-6">

    {{-- Chart Kunjungan 7 Hari --}}
    <div class="xl:col-span-2 rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-base font-semibold text-gray-800 dark:text-white">Grafik Kunjungan 7 Hari</h3>
                <p class="text-sm text-gray-400">Perbandingan kunjungan harian vs member</p>
            </div>
        </div>
        <canvas id="chartKunjungan" height="100"></canvas>
    </div>

    {{-- Member Akan Expired --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-4">⚠️ Segera Expired</h3>
        @forelse($memberAkanExpired as $m)
        <div class="flex items-center justify-between py-2.5 border-b border-gray-100 dark:border-gray-800 last:border-0">
            <div class="flex items-center gap-3">
                <img src="{{ $m->user->foto_url ?? asset('images/default-avatar.png') }}"
                    class="w-8 h-8 rounded-full object-cover">
                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $m->user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $m->kodeMember }}</p>
                </div>
            </div>
            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-red-50 text-red-500 dark:bg-red-500/10">
                {{ \Carbon\Carbon::parse($m->tanggalAkhir)->diffInDays(today()) }}h lagi
            </span>
        </div>
        @empty
        <div class="text-center py-8">
            <p class="text-sm text-gray-400">Tidak ada member yang akan expired.</p>
        </div>
        @endforelse
    </div>

</div>

{{-- ── Baris 3: Member Terbaru ── --}}
<div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="flex items-center justify-between px-6 mb-4">
        <div>
            <h3 class="text-base font-semibold text-gray-800 dark:text-white">Member Terbaru</h3>
            <p class="text-sm text-gray-400">5 pendaftaran terakhir</p>
        </div>
        <a href="{{ route('admin.member.index') }}"
            class="text-sm text-blue-600 hover:underline dark:text-blue-400">
            Lihat Semua →
        </a>
    </div>

    <div class="max-w-full px-5 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-gray-200 border-y dark:border-gray-700">
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Member</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Kode</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Paket</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Berlaku s/d</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($memberTerbaru as $m)
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <img src="{{ $m->user->foto_url ?? asset('images/default-avatar.png') }}"
                                class="w-8 h-8 rounded-full object-cover">
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $m->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $m->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400">
                            {{ $m->kodeMember }}
                        </span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $m->paket->namaPaket ?? '-' }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($m->tanggalAkhir)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if($m->statusMember === 'aktif')
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400">Aktif</span>
                        @else
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-red-50 text-red-500 dark:bg-red-500/15 dark:text-red-400">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-400">Belum ada data member.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $totalMember }} member terdaftar</p>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartKunjungan').getContext('2d');
const isDark = document.documentElement.classList.contains('dark');
const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
const labelColor = isDark ? '#9ca3af' : '#6b7280';

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [
            {
                label: 'Kunjungan Member',
                data: {!! json_encode($dataMember) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                borderRadius: 6,
            },
            {
                label: 'Kunjungan Harian',
                data: {!! json_encode($dataHarian) !!},
                backgroundColor: 'rgba(168, 85, 247, 0.8)',
                borderRadius: 6,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: { color: labelColor, font: { size: 12 } }
            }
        },
        scales: {
            x: {
                ticks: { color: labelColor },
                grid: { color: gridColor }
            },
            y: {
                beginAtZero: true,
                ticks: { color: labelColor, stepSize: 1 },
                grid: { color: gridColor }
            }
        }
    }
});
</script>
@endpush

@endsection