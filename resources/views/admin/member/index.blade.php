@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Data Member" />

@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="mb-4 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700 text-sm flex items-center justify-between dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-400">
    <span>{{ session('success') }}</span>
    <button @click="show = false">✕</button>
</div>
@endif

<div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">

    {{-- Header --}}
    <div class="flex flex-col gap-2 px-5 mb-4 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Data Member</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola data member gym</p>
        </div>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')"
            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" d="M12 5v14M5 12h14"/></svg>
            Tambah Member
        </button>
    </div>

    {{-- Table --}}
    <div class="overflow-hidden">
        <div class="max-w-full px-5 overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-gray-200 border-y dark:border-gray-700">
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Member</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Kode</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">No. Daftar</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Paket</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Berlaku s/d</th>
                        <th class="px-4 py-3 font-normal text-gray-500 text-start text-theme-sm dark:text-gray-400">Status</th>
                        <th class="relative px-4 py-3"><span class="sr-only">Aksi</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($member as $index => $m)
                    <tr>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <img src="{{ $m->user->foto_url ?? asset('images/default-avatar.png') }}"
                                    class="w-8 h-8 rounded-full object-cover">
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $m->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $m->user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400">
                                {{ $m->kodeMember }}
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $m->noPendaftaran }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $m->paket->namaPaket ?? '-' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($m->tanggalAkhir)->format('d M Y') }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($m->statusMember === 'aktif')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400">Aktif</span>
                            @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-50 text-red-500 dark:bg-red-500/15 dark:text-red-400">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
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
                                        <button onclick="editMember(
                                            {{ $m->idMember }},
                                            '{{ addslashes($m->user->name) }}',
                                            '{{ $m->user->noTelp }}',
                                            {{ $m->idPaket }},
                                            '{{ $m->tanggalDaftar }}',
                                            '{{ $m->statusMember }}')"
                                            class="flex w-full px-3 py-2 font-medium text-left text-gray-500 rounded-lg text-theme-xs hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.member.destroy', $m->idMember) }}" method="POST"
                                            onsubmit="return confirm('Yakin? Akun user terkait juga akan dihapus!')">
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
                            Belum ada data member.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="px-6 py-4 border-t border-gray-200 dark:border-white/[0.05]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $member->count() }} member</p>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div id="modalTambah" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-5">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Tambah Member Baru</h4>
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form action="{{ route('admin.member.store') }}" method="POST" class="space-y-4">
            @csrf

            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">— Data Akun —</p>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama lengkap member"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                <input type="email" name="email" required placeholder="email@example.com"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password</label>
                <input type="password" name="password" required placeholder="Min. 6 karakter"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                    <input type="text" name="noTelp" placeholder="08xxxxxxxxxx"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
                    <select name="jenisKelamin"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                <input type="text" name="tanggalLahir"
                    class="datepicker w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Pilih tanggal lahir">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                <textarea name="alamat" rows="2" placeholder="Alamat lengkap"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">— Data Membership —</p>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Paket Member</label>
                <select name="idPaket" required id="selectPaketTambah" onchange="updateTanggalAkhir('tambah')"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Paket --</option>
                    @foreach($paket as $p)
                    <option value="{{ $p->idPaket }}" data-durasi="{{ $p->durasiPaket }}">
                        {{ $p->namaPaket }} ({{ $p->durasiPaket }} hari) — Rp {{ number_format($p->hargaPaket, 0, ',', '.') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Daftar</label>
                <input type="text" name="tanggalDaftar" id="tanggalDaftarTambah" required
                    value="{{ date('Y-m-d') }}"
                    onchange="updateTanggalAkhir('tambah')"
                    class="datepicker w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Pilih tanggal daftar">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Berlaku s/d (otomatis)</label>
                <input type="text" id="previewTanggalAkhirTambah" readonly placeholder="Pilih paket & tanggal daftar"
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 cursor-not-allowed">
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modalTambah').classList.add('hidden')"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">Batal</button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="modalEdit" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-lg mx-4 p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-5">
            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Edit Member</h4>
            <button onclick="document.getElementById('modalEdit').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>
        <form id="formEdit" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                <input type="text" id="editName" name="name" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                <input type="text" id="editNoTelp" name="noTelp"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Paket Member</label>
                <select id="editPaket" name="idPaket" required onchange="updateTanggalAkhir('edit')"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach($paket as $p)
                    <option value="{{ $p->idPaket }}" data-durasi="{{ $p->durasiPaket }}">
                        {{ $p->namaPaket }} ({{ $p->durasiPaket }} hari)
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Daftar</label>
                <input type="text" id="editTanggalDaftar" name="tanggalDaftar" required
                    onchange="updateTanggalAkhir('edit')"
                    class="datepicker w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Berlaku s/d (otomatis)</label>
                <input type="text" id="previewTanggalAkhirEdit" readonly
                    class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 cursor-not-allowed">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select id="editStatus" name="statusMember" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('modalEdit').classList.add('hidden')"
                    class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 dark:border-gray-700 dark:text-gray-400">Batal</button>
                <button type="submit"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// Paket durasi map
const paketDurasi = {
    @foreach($paket as $p)
    {{ $p->idPaket }}: {{ $p->durasiPaket }},
    @endforeach
};

function updateTanggalAkhir(mode) {
    const selectId  = mode === 'tambah' ? 'selectPaketTambah' : 'editPaket';
    const dateId    = mode === 'tambah' ? 'tanggalDaftarTambah' : 'editTanggalDaftar';
    const previewId = mode === 'tambah' ? 'previewTanggalAkhirTambah' : 'previewTanggalAkhirEdit';

    const idPaket  = document.getElementById(selectId).value;
    const tglDaftar = document.getElementById(dateId).value;

    if (idPaket && tglDaftar && paketDurasi[idPaket]) {
        const durasi = paketDurasi[idPaket];
        const hasil  = new Date(tglDaftar);
        hasil.setDate(hasil.getDate() + durasi);
        document.getElementById(previewId).value = hasil.toLocaleDateString('id-ID', {
            day: '2-digit', month: 'long', year: 'numeric'
        });
    }
}

function editMember(id, name, noTelp, idPaket, tanggalDaftar, status) {
    document.getElementById('formEdit').action  = `/admin/member/${id}`;
    document.getElementById('editName').value   = name;
    document.getElementById('editNoTelp').value = noTelp;
    document.getElementById('editPaket').value  = idPaket;
    document.getElementById('editTanggalDaftar').value = tanggalDaftar;
    document.getElementById('editStatus').value = status;
    updateTanggalAkhir('edit');
    document.getElementById('modalEdit').classList.remove('hidden');
}
</script>
@endpush

@endsection