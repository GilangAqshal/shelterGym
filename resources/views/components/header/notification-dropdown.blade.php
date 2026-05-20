@php
    // Hanya load notifikasi untuk admin & owner
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'owner'])) {
        return;
    }
    $notifikasi  = \App\Models\Notifikasi::orderBy('created_at', 'desc')->take(10)->get();
    $unreadCount = \App\Models\Notifikasi::where('isRead', 0)->count();
@endphp

<div class="relative" x-data="{ open: false }" @click.away="open = false">

    {{-- Bell Button --}}
    <button @click="open = !open"
        class="relative flex items-center justify-center w-10 h-10 text-gray-500 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 transition">
        <svg width="20" height="20" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        @if($unreadCount > 0)
        <span class="absolute -top-0.5 -right-0.5 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>
        @endif
    </button>

    {{-- Dropdown --}}
    <div x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-3 w-80 rounded-2xl border border-gray-200 bg-white shadow-xl dark:border-gray-800 dark:bg-gray-900 z-50"
        style="display: none;">

        {{-- Header Dropdown --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-2">
                <h5 class="text-sm font-semibold text-gray-800 dark:text-white">Notifikasi</h5>
                @if($unreadCount > 0)
                <span class="px-2 py-0.5 text-xs font-bold bg-red-100 text-red-600 rounded-full dark:bg-red-500/15 dark:text-red-400">
                    {{ $unreadCount }} baru
                </span>
                @endif
            </div>
            @if($unreadCount > 0)
            <form action="{{ route('admin.notifikasi.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs text-blue-600 hover:underline dark:text-blue-400">
                    Tandai semua dibaca
                </button>
            </form>
            @endif
        </div>

        {{-- List Notifikasi --}}
        <div class="max-h-80 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-800">
            @forelse($notifikasi as $n)
            <div onclick="handleNotifClick({{ $n->id }}, '{{ route('admin.member.index') }}')"
                class="flex gap-3 px-5 py-3.5 cursor-pointer transition hover:bg-gray-50 dark:hover:bg-white/[0.03]
                    {{ !$n->isRead ? 'bg-blue-50/60 dark:bg-blue-500/5' : '' }}">

                {{-- Icon --}}
                <div class="shrink-0 mt-0.5">
                    <span class="flex items-center justify-center w-9 h-9 rounded-full
                        {{ $n->tipe === 'pembelian_member' ? 'bg-blue-100 dark:bg-blue-500/20' : 'bg-gray-100 dark:bg-gray-800' }}">
                        @if($n->tipe === 'pembelian_member')
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                            <path stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        @else
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24">
                            <path stroke="#6b7280" stroke-width="2" stroke-linecap="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        @endif
                    </span>
                </div>

                {{-- Konten --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white leading-tight">
                            {{ $n->judul }}
                        </p>
                        @if(!$n->isRead)
                        <span class="shrink-0 w-2 h-2 mt-1.5 rounded-full bg-blue-500"></span>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5 line-clamp-2">
                        {{ $n->pesan }}
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                        {{ \Carbon\Carbon::parse($n->created_at)->diffForHumans() }}
                    </p>
                </div>
            </div>
            @empty
            <div class="px-5 py-10 text-center">
                <p class="text-3xl mb-2">🔔</p>
                <p class="text-sm text-gray-400">Belum ada notifikasi.</p>
            </div>
            @endforelse
        </div>

        {{-- Footer --}}
        @if($notifikasi->count() > 0)
        <div class="px-5 py-3 border-t border-gray-100 dark:border-gray-800 text-center">
            <a href="{{ route('admin.member.index') }}"
                class="text-xs text-blue-600 hover:underline dark:text-blue-400">
                Lihat semua data member →
            </a>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function handleNotifClick(id, url) {
    fetch(`/admin/notifikasi/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    }).then(() => {
        window.location.href = url;
    }).catch(() => {
        window.location.href = url;
    });
}
</script>
@endpush