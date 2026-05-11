@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Laporan" />

{{-- Filter - Dibuat lebih ringkas --}}
<div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03] mb-4">
    <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap items-end gap-3">
        <div class="flex gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                <select name="bulan" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach(range(1,12) as $b)
                    <option value="{{ $b }}" {{ $bulan == $b ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create(null, $b)->translatedFormat('F') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                <select name="tahun" class="rounded-lg border border-gray-300 px-3 py-1.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach(range(date('Y'), date('Y')-3) as $y)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="self-end rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Filter
            </button>
        </div>

        {{-- Export Buttons - Menggunakan icon saja atau text kecil --}}
        <div class="flex gap-2 ml-auto">
            <a href="{{ route('admin.laporan.pdf', ['bulan'=>$bulan,'tahun'=>$tahun]) }}" class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-xs font-medium text-white hover:bg-red-700">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                PDF
            </a>
            <a href="{{ route('admin.laporan.excel', ['bulan'=>$bulan,'tahun'=>$tahun]) }}" class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-3 py-2 text-xs font-medium text-white hover:bg-green-700">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                Excel
            </a>
        </div>
    </form>
</div>

{{-- Stat Cards - Lebih Padat --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-4">
    <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Pendapatan</p>
        <p class="text-xl font-bold text-gray-800 dark:text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        <p class="text-[10px] text-gray-400 mt-1">{{ $namaBulan }} {{ $tahun }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Total Kunjungan</p>
        <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $totalKunjungan }}</p>
        <div class="flex gap-2 mt-1">
            <span class="text-[10px] text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">{{ $kunjunganMember->count() }} member</span>
            <span class="text-[10px] text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">{{ $kunjunganHarian->count() }} harian</span>
        </div>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Member Baru</p>
        <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $memberBaru }}</p>
        <p class="text-[10px] text-gray-400 mt-1">Pendaftar bulan ini</p>
    </div>
</div>

{{-- Grafik - Dibuat tidak terlalu tinggi --}}
<div class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-white/[0.03] mb-4">
    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Grafik Kunjungan</h3>
    <div class="h-[250px] mt-2"> {{-- Membatasi tinggi kontainer grafik --}}
        <canvas id="chartLaporan"></canvas>
    </div>
</div>

{{-- Grid untuk Tabel agar berdampingan jika layar cukup lebar --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    {{-- Tabel Kunjungan Harian --}}
    <div class="rounded-2xl border border-gray-200 bg-white pt-3 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-4 mb-2">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Kunjungan Harian</h3>
        </div>
        <div class="overflow-x-auto px-2">
            <table class="min-w-full text-xs">
                <thead>
                    <tr class="border-y border-gray-100 dark:border-gray-700">
                        <th class="px-2 py-2 text-start text-gray-500">Invoice</th>
                        <th class="px-2 py-2 text-start text-gray-500">Nama</th>
                        <th class="px-2 py-2 text-start text-gray-500">Harga</th>
                        <th class="px-2 py-2 text-start text-gray-500">Tgl</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($kunjunganHarian->take(10) as $item) {{-- Limit tampilan biar tidak panjang --}}
                    <tr>
                        <td class="px-2 py-2 font-medium text-blue-600">{{ $item->invoice }}</td>
                        <td class="px-2 py-2 text-gray-700 dark:text-gray-300">{{ Str::limit($item->namaPengunjung, 15) }}</td>
                        <td class="px-2 py-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="px-2 py-2 text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-4 text-center text-gray-400">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tabel Kunjungan Member --}}
    <div class="rounded-2xl border border-gray-200 bg-white pt-3 dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-4 mb-2">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Kunjungan Member</h3>
        </div>
        <div class="overflow-x-auto px-2">
            <table class="min-w-full text-xs">
                <thead>
                    <tr class="border-y border-gray-100 dark:border-gray-700">
                        <th class="px-2 py-2 text-start text-gray-500">Invoice</th>
                        <th class="px-2 py-2 text-start text-gray-500">Nama</th>
                        <th class="px-2 py-2 text-start text-gray-500">Tgl</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($kunjunganMember->take(10) as $item)
                    <tr>
                        <td class="px-2 py-2 font-medium text-purple-600">{{ $item->invoice }}</td>
                        <td class="px-2 py-2 text-gray-700 dark:text-gray-300">{{ Str::limit($item->member->user->name ?? '-', 15) }}</td>
                        <td class="px-2 py-2 text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="py-4 text-center text-gray-400">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartLaporan').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode($grafikLabels) !!},
        datasets: [
            {
                label: 'Member',
                data: {!! json_encode($grafikMember) !!},
                backgroundColor: 'rgba(59,130,246,0.8)',
                borderRadius: 4,
            },
            {
                label: 'Harian',
                data: {!! json_encode($grafikHarian) !!},
                backgroundColor: 'rgba(168,85,247,0.8)',
                borderRadius: 4,
            }
        ]
    },
    options: {
        maintainAspectRatio: false, // Penting agar mengikuti tinggi kontainer div
        responsive: true,
        plugins: {
            legend: { position: 'top', labels: { boxWidth: 10, font: { size: 10 } } }
        },
        scales: {
            y: { beginAtZero: true, ticks: { font: { size: 10 } } },
            x: { ticks: { font: { size: 10 } } }
        }
    }
});
</script>
@endpush
@endsection