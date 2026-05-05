@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Kunjungan Harian" />

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="mb-4 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700 text-sm flex items-center justify-between dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-400">
    <span>{{ session('success') }}</span>
    <button @click="show = false">✕</button>
</div>
@endif

<div class="space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

        {{-- Header --}}
        <div class="flex flex-col gap-2 px-5 mb-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Data Kunjungan Harian</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Transaksi pengunjung non-member</p>
            </div>
            <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                Tambah Kunjungan
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-hidden">
            <div class="max-w-full px-5 overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-gray-200 border-y dark:border-gray-700">
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Invoice</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama Pengunjung</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No. Telp</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Paket</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Harga</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Tanggal</th>
                            <th class="relative px-4 py-3"><span class="sr-only">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($kunjungan as $index => $item)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400">
                                    {{ $item->invoice }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->namaPengunjung }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->noTelp ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item->paketHarian->namaKategori ?? '-' }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <div class="flex justify-center relative">
                                    <x-common.table-dropdown>
                                        <x-slot name="button">
                                            <button type="button" class="text-gray-500 dark:text-gray-400">
                                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.99902 10.245C6.96552 10.245 7.74902 11.0285 7.74902 11.995V12.005C7.74902 12.9715 6.96552 13.755 5.99902 13.755C5.03253 13.755 4.24902 12.9715 4.24902 12.005V11.995C4.24902 11.0285 5.03253 10.245 5.99902 10.245ZM17.999 10.245C18.9655 10.245 19.749 11.0285 19.749 11.995V12.005C19.749 12.9715 18.9655 13.755 17.999 13.755C17.0325 13.755 16.249 12.9715 16.249 12.005V11.995C16.249 11.0285 17.0325 10.245 17.999 10.245ZM13.749 11.995C13.749 11.0285 12.9655 10.245 11.999 10.245C11.0325 10.245 10.249 11.0285 10.249 11.995V12.005C10.249 12.9715 11.0325 13.755 11.999 13.755C12.9655 13.755 13.749 12.9715 13.749 12.005V11.995Z" fill="currentColor"/>
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <form action="{{ route('admin.kunjungan-harian.destroy', $item->idKunjungan) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="flex w-full px-3 py-2 font-medium text-left text-red-500 rounded-lg text-theme-xs hover:bg-red-50 dark:hover:bg-red-500/10">
                                                    Hapus
                                                </button>
                                            </form>
                                        </x-slot>
                                    </x-common.table-dropdown>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-sm text-gray-400">
                                Belum ada data kunjungan harian.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
            <p class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $kunjungan->count() }} kunjungan</p>
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex items-center justify-between mb-5">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Tambah Kunjungan Harian</h4>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('admin.kunjungan-harian.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Pengunjung</label>
                <input type="text" name="namaPengunjung" required placeholder="Nama lengkap"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                <input type="text" name="noTelp" placeholder="08xxxxxxxxxx"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Paket</label>
                <select name="idPaketHarian" required id="selectPaket" onchange="updateHarga(this)"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Paket --</option>
                    @foreach($paket as $p)
                    <option value="{{ $p->idPaketHarian }}" data-harga="{{ $p->harga }}">
                        {{ $p->namaKategori }} — Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga</label>
                <input type="text" id="previewHarga" readonly placeholder="Otomatis terisi"
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 cursor-not-allowed">
            </div>
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Kunjungan</label>
    <div class="relative">
        <input type="text" name="tanggal" required value="{{ date('Y-m-d') }}"
            class="datepicker w-full rounded-lg border border-gray-300 px-4 py-2.5 pl-10 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Pilih tanggal">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </span>
    </div>
</div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function updateHarga(select) {
    const option = select.options[select.selectedIndex];
    const harga  = option.dataset.harga;
    const preview = document.getElementById('previewHarga');
    if (harga) {
        preview.value = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
    } else {
        preview.value = '';
    }
}
</script>
@endpush

@endsection