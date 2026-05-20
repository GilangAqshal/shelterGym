@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Riwayat Kunjungan" />

<div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

    <div class="flex items-center justify-between px-6 mb-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Riwayat Kunjungan Saya</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                @if($member)
                    Kode Member:
                    <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $member->kodeMember }}</span>
                @else
                    Belum terdaftar sebagai member
                @endif
            </p>
        </div>
        <a href="{{ route('user.dashboard') }}"
            class="text-sm text-gray-500 hover:text-blue-600 dark:text-gray-400 flex items-center gap-1">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M19 12H5M12 5l-7 7 7 7"/>
            </svg>
            Kembali
        </a>
    </div>

    <div class="overflow-hidden">
        <div class="max-w-full px-5 overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-gray-200 border-y dark:border-gray-700">
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Invoice</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Hari</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tipe</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($kunjungan as $index => $k)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ ($kunjungan->currentPage() - 1) * $kunjungan->perPage() + $index + 1 }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full
                                {{ str_starts_with($k->invoice, 'SELF')
                                    ? 'bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400'
                                    : 'bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400' }}">
                                {{ $k->invoice }}
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-white">
                            {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('l') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if(str_starts_with($k->invoice, 'SELF'))
                            <span class="text-xs px-2 py-1 rounded-full bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400">
                                Mandiri
                            </span>
                            @else
                            <span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400">
                                Admin
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <p class="text-4xl mb-3">📋</p>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Belum ada riwayat kunjungan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination + Total --}}
    <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05] flex items-center justify-between">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Total: {{ $kunjungan instanceof \Illuminate\Pagination\LengthAwarePaginator ? $kunjungan->total() : $kunjungan->count() }} kunjungan
        </p>
        @if($kunjungan instanceof \Illuminate\Pagination\LengthAwarePaginator && $kunjungan->hasPages())
        {{ $kunjungan->links() }}
        @endif
    </div>

</div>
@endsection