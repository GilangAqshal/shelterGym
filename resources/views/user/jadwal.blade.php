@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Jadwal Latihan" />

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
    @foreach($jadwal as $j)
    <div class="rounded-2xl border bg-white dark:bg-white/[0.03] overflow-hidden
        {{ $j->hari === $hariIni
            ? 'border-blue-400 dark:border-blue-500 ring-2 ring-blue-400/30'
            : 'border-gray-200 dark:border-gray-800' }}">

        {{-- Header Hari --}}
        <div class="px-5 py-4 flex items-center justify-between
            {{ $j->hari === $hariIni
                ? 'bg-blue-600'
                : 'bg-gray-50 dark:bg-white/[0.03]' }}">
            <div>
                <h3 class="font-bold text-base
                    {{ $j->hari === $hariIni ? 'text-white' : 'text-gray-800 dark:text-white' }}">
                    {{ $j->hari }}
                </h3>
                <p class="text-sm
                    {{ $j->hari === $hariIni ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }}">
                    {{ $j->fokusLatihan }}
                </p>
            </div>
            @if($j->hari === $hariIni)
            <span class="px-2 py-1 text-xs font-bold bg-white/20 text-white rounded-full">
                Hari Ini
            </span>
            @endif
        </div>

        {{-- Daftar Gerakan --}}
        <div class="divide-y divide-gray-100 dark:divide-gray-800">
            @forelse($j->gerakan->sortBy('urutan') as $g)
            <div class="flex items-center gap-4 px-5 py-3">
                <img src="{{ $g->gambar_url }}" alt="{{ $g->namaGerakan }}"
                    class="w-14 h-14 rounded-lg object-cover shrink-0" loading="eager">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 dark:text-white truncate">
                        {{ $g->namaGerakan }}
                    </p>
                    @if($g->set_reps)
                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400 mt-1 inline-block">
                        {{ $g->set_reps }}
                    </span>
                    @endif
                    @if($g->deskripsi)
                    <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $g->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-5 py-6 text-center">
                <p class="text-sm text-gray-400">Belum ada gerakan.</p>
            </div>
            @endforelse
        </div>

        {{-- Footer --}}
        <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800">
            <p class="text-xs text-gray-400">{{ $j->gerakan->count() }} gerakan</p>
        </div>
    </div>
    @endforeach
</div>

@endsection