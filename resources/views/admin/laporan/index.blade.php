@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Laporan" />

{{-- Filter --}}
<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] mb-6">
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap items-end gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
            <select name="bulan"
                class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(range(1,12) as $b)
                <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create(null, $b)->translatedFormat('F') }}
                </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
            <select name="tahun"
                class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(range(date('Y'), date('Y')-3) as $y)
                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700">
            Filter
        </button>

        {{-- Export Buttons --}}
        <div class="flex gap-2 ml-auto">
            <a href="{{ route('admin.laporan.pdf', ['bulan'=>$bulan,'tahun'=>$tahun]) }}"
                class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>
                Export PDF
            </a>
            <a href="{{ route('admin.laporan.excel', ['bulan'=>$bulan,'tahun'=>$tahun]) }}"
                class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                </svg>
                Export Excel
            </a>
        </div>
    </form>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-6">
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Pendapatan</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">
            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
        </p>
        <p class="text-xs text-gray-400 mt-1">{{ $namaBulan }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Kunjungan</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $totalKunjungan }}</p>
        <div class="flex gap-2 mt-1">
            <span class="text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $kunjunganMember->count() }} member</span>
            <span class="text-xs text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">{{ $kunjunganHarian->count() }} harian</span>
        </div>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Member Baru</p>
        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $memberBaru }}</p>
        <p class="text-xs text-gray-400 mt-1">Pendaftar bulan ini</p>
    </div>
</div>

{{-- Grafik --}}
<div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] mb-6">
    <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-1">Grafik Kunjungan — {{ $namaBulan }}</h3>
    <p class="text-sm text-gray-400 mb-4">Kunjungan harian vs member per hari</p>
    <canvas id="chartLaporan" height="80"></canvas>
</div>

{{-- Tabel Kunjungan Harian --}}
<div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03] mb-6">
    <div class="px-6 mb-4">
        <h3 class="text-base font-semibold text-gray-800 dark:text-white">Kunjungan Harian</h3>
        <p class="text-sm text-gray-400">{{ $kunjunganHarian->count() }} transaksi</p>
    </div>
    <div class="max-w-full px-5 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-gray-200 border-y dark:border-gray-700">
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Invoice</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama Pengunjung</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Paket</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Harga</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($kunjunganHarian as $index => $item)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400">{{ $item->invoice }}</span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-white">{{ $item->namaPengunjung }}</td>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $item->paketHarian->namaKategori ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-4 py-6 text-center text-sm text-gray-400">Tidak ada data kunjungan harian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
        <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
            Total Pendapatan: Rp {{ number_format($kunjunganHarian->sum('harga'), 0, ',', '.') }}
        </p>
    </div>
</div>

{{-- Tabel Kunjungan Member --}}
<div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-6 mb-4">
        <h3 class="text-base font-semibold text-gray-800 dark:text-white">Kunjungan Member</h3>
        <p class="text-sm text-gray-400">{{ $kunjunganMember->count() }} kunjungan</p>
    </div>
    <div class="max-w-full px-5 overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="border-gray-200 border-y dark:border-gray-700">
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Invoice</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Kode Member</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama Member</th>
                    <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($kunjunganMember as $index => $item)
                <tr>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        <span class="text-xs font-semibold px-2 py-1 rounded-full bg-purple-50 text-purple-600 dark:bg-purple-500/15 dark:text-purple-400">{{ $item->invoice }}</span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $item->member->kodeMember ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-800 dark:text-white">{{ $item->member->user->name ?? '-' }}</td>
                    <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-gray-400">Tidak ada data kunjungan member.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $kunjunganMember->count() }} kunjungan</p>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartLaporan').getContext('2d');
const isDark = document.documentElement.classList.contains('dark');
const gridColor  = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
const labelColor = isDark ? '#9ca3af' : '#6b7280';

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($grafikLabels) !!},
        datasets: [
            {
                label: 'Kunjungan Member',
                data: {!! json_encode($grafikMember) !!},
                backgroundColor: 'rgba(59,130,246,0.8)',
                borderRadius: 4,
            },
            {
                label: 'Kunjungan Harian',
                data: {!! json_encode($grafikHarian) !!},
                backgroundColor: 'rgba(168,85,247,0.8)',
                borderRadius: 4,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: labelColor, font: { size: 12 } } }
        },
        scales: {
            x: { ticks: { color: labelColor }, grid: { color: gridColor } },
            y: { beginAtZero: true, ticks: { color: labelColor, stepSize: 1 }, grid: { color: gridColor } }
        }
    }
});
</script>
@endpush

@endsection