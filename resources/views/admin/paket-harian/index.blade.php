@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Paket Harian" />

{{-- Alert --}}
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
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Data Paket Harian</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelola paket kunjungan harian</p>
            </div>
            <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
                class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
                Tambah Paket
            </button>
        </div>

        {{-- Table --}}
        <div class="overflow-hidden">
            <div class="max-w-full px-5 overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-gray-200 border-y dark:border-gray-700">
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Nama Kategori</th>
                            <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Harga</th>
                            <th class="relative px-4 py-3"><span class="sr-only">Aksi</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($paket as $index => $item)
                        <tr>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->namaKategori }}</div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
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
                                            <button onclick="editPaket({{ $item->idPaketHarian }}, '{{ $item->namaKategori }}', {{ $item->harga }})"
                                                class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.paket-harian.destroy', $item->idPaketHarian) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
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
                            <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-400">
                                Belum ada data paket harian.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
            <p class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $paket->count() }} paket</p>
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex items-center justify-between mb-5">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Tambah Paket Harian</h4>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('admin.paket-harian.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kategori</label>
                <input type="text" name="namaKategori" required placeholder="contoh: Sehari"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga (Rp)</label>
                <input type="number" name="harga" required min="0" placeholder="20000"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
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

{{-- MODAL EDIT --}}
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
        <div class="flex items-center justify-between mb-5">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Edit Paket Harian</h4>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kategori</label>
                <input type="text" id="editNama" name="namaKategori" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga (Rp)</label>
                <input type="number" id="editHarga" name="harga" required min="0"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">
                    Batal
                </button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function editPaket(id, nama, harga) {
    document.getElementById('formEdit').action = `/admin/paket-harian/${id}`;
    document.getElementById('editNama').value  = nama;
    document.getElementById('editHarga').value = harga;
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
@endpush

@endsection