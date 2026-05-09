@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Profil Saya" />

{{-- Alert Success --}}
@if(session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="mb-4 rounded-xl bg-green-50 border border-green-200 px-5 py-4 text-green-700 text-sm flex items-center justify-between dark:bg-green-500/10 dark:border-green-500/20 dark:text-green-400">
    <span>{{ session('success') }}</span>
    <button @click="show = false">✕</button>
</div>
@endif

@if(session('success_password'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
    class="mb-4 rounded-xl bg-blue-50 border border-blue-200 px-5 py-4 text-blue-700 text-sm flex items-center justify-between dark:bg-blue-500/10 dark:border-blue-500/20 dark:text-blue-400">
    <span>{{ session('success_password') }}</span>
    <button @click="show = false">✕</button>
</div>
@endif

<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    {{-- ── Kolom Kiri: Foto Profil ── --}}
    <div class="xl:col-span-1">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">

            {{-- Foto --}}
            <div class="flex flex-col items-center text-center">
                <div class="relative mb-4">
                    <img id="previewFoto"
                        src="{{ $user->foto_url }}"
                        alt="Foto Profil"
                        class="w-28 h-28 rounded-full object-cover border-4 border-blue-100 dark:border-blue-500/20">
                    <label for="inputFoto"
                        class="absolute bottom-0 right-0 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center cursor-pointer hover:bg-blue-700 transition">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24">
                            <path stroke="white" stroke-width="2" stroke-linecap="round"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </label>
                </div>

                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h3>
                <span class="mt-1 px-3 py-1 text-xs font-semibold rounded-full
                    {{ $user->role === 'owner' ? 'bg-purple-50 text-purple-600 dark:bg-purple-500/15 dark:text-purple-400' :
                       ($user->role === 'admin' ? 'bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-400' :
                       'bg-green-50 text-green-600 dark:bg-green-500/15 dark:text-green-400') }}">
                    {{ ucfirst($user->role) }}
                </span>
                <p class="text-sm text-gray-400 mt-2">{{ $user->email }}</p>
            </div>

            <hr class="my-5 border-gray-100 dark:border-gray-800">

            {{-- Info Singkat --}}
            <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="text-gray-400 shrink-0">
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">{{ $user->noTelp ?? 'Belum diisi' }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="text-gray-400 shrink-0">
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">{{ $user->alamat ?? 'Belum diisi' }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" class="text-gray-400 shrink-0">
                        <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-gray-600 dark:text-gray-400">
                        {{ $user->tanggalLahir ? \Carbon\Carbon::parse($user->tanggalLahir)->translatedFormat('d F Y') : 'Belum diisi' }}
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Kolom Kanan: Form Edit ── --}}
    <div class="xl:col-span-2 space-y-6">

        {{-- Form Edit Profil --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-5">Edit Informasi Profil</h3>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                {{-- Input foto tersembunyi --}}
                <input type="file" id="inputFoto" name="foto" accept="image/*" class="hidden"
                    onchange="previewGambar(this)">

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                            @error('name') border-red-400 @enderror">
                        @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                            @error('email') border-red-400 @enderror">
                        @error('email')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
                        <input type="text" name="noTelp" value="{{ old('noTelp', $user->noTelp) }}"
                            placeholder="08xxxxxxxxxx"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
                        <select name="jenisKelamin"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenisKelamin', $user->jenisKelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenisKelamin', $user->jenisKelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Lahir</label>
                    <input type="text" name="tanggalLahir"
                        value="{{ old('tanggalLahir', $user->tanggalLahir) }}"
                        class="datepicker w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Pilih tanggal lahir">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                    <textarea name="alamat" rows="3" placeholder="Alamat lengkap"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- Form Ganti Password --}}
        <div class="rounded-2xl border border-gray-200 bg-white p-6 dark:border-gray-800 dark:bg-white/[0.03]">
            <h3 class="text-base font-semibold text-gray-800 dark:text-white mb-1">Ganti Password</h3>
            <p class="text-sm text-gray-400 mb-5">Pastikan password baru minimal 6 karakter.</p>

            <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Lama</label>
                    <input type="password" name="current_password" placeholder="Masukkan password lama"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                        @error('current_password') border-red-400 @enderror">
                    @error('current_password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password Baru</label>
                    <input type="password" name="password" placeholder="Masukkan password baru"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500
                        @error('password') border-red-400 @enderror">
                    @error('password')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="rounded-lg bg-red-600 px-6 py-2.5 text-sm font-medium text-white hover:bg-red-700 transition">
                        Ganti Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
function previewGambar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewFoto').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection