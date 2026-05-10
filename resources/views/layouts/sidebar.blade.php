@php
    $currentPath = request()->path();
@endphp

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-99999 border-r border-gray-200"
    x-data="{
        isActive(path) {
            return window.location.pathname === path || '{{ $currentPath }}' === path.replace(/^\//, '');
        }
    }"
    :class="{
        'w-[250px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
        'w-[80px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full xl:translate-x-0': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)">
    
<!-- Logo Section -->
<div class="pt-8 pb-7 flex items-center"
    :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
    'justify-center' :
    'justify-start px-2'"> <!-- Tambahkan px-2 atau sesuaikan agar sejajar dengan margin menu -->
    
    <a href="{{ route('admin.dashboard') }}" class="flex items-center">
        <!-- Logo Full (Saat Sidebar Terbuka) -->
        <div x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
            <img class="dark:hidden" src="/images/logo/logo.png" alt="Logo" style="width: 154px; height: 32px;" />
            <img class="hidden dark:block" src="/images/logo/logo_dark.png" alt="Logo" style="width: 154px; height: 32px;" />
        </div>

        <!-- Logo Icon Only (Saat Sidebar Tertutup) -->
        <img x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen"
            src="/images/logo/logo_icon.png" alt="Logo" width="32" height="32" />
    </a>
</div>

    <!-- Navigation Menu -->
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav class="mb-6">
            <ul class="flex flex-col gap-1">
                
                <!-- Menu Item: Dashboard -->
<li>
    <a href="{{ auth()->user()->role === 'user' ? route('user.dashboard') : route('admin.dashboard') }}"
        class="menu-item group"
        :class="[
            {{ request()->routeIs('*.dashboard') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
        ]">
        
        <span class="{{ request()->routeIs('*.dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
        </span>

        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
            class="menu-item-text">
            Dashboard
        </span>
    </a>
</li>

{{-- Menu khusus User (Hanya muncul jika login sebagai User) --}}
@if(auth()->user()->role === 'user')
<li>
    <a href="{{ route('user.jadwal') }}"
        class="menu-item group"
        :class="[
            {{ request()->routeIs('user.jadwal') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
        ]">
        
        <span class="{{ request()->routeIs('user.jadwal') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
            </svg>
        </span>

        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
            class="menu-item-text">
            Jadwal Latihan
        </span>
    </a>
</li>
@endif
                
                {{-- Menu khusus Owner --}}
                @if(auth()->user()->role === 'owner')
                <li>
                    <a href="{{ route('admin.admin.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.admin.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.admin.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <!-- Icon User Shield / Admin -->
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                            class="menu-item-text">
                            Manajemen Admin
                        </span>
                    </a>
                </li>
                @endif

                <!-- Menu Item: Paket Member -->
                <li>
                    <a href="{{ route('admin.paket-member.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.paket-member.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.paket-member.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" 
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                              class="menu-item-text">
                            Paket Member
                        </span>
                    </a>
                </li>

                <!-- Menu Item: Paket Harian -->
                <li>
                    <a href="{{ route('admin.paket-harian.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.paket-harian.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.paket-harian.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                              class="menu-item-text">
                            Paket Harian
                        </span>
                    </a>
                </li>

                <!-- Menu Item: Data Member -->
                <li>
                    <a href="{{ route('admin.member.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.member.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.member.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <!-- Icon Users -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>


                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                            class="menu-item-text">
                            Data Member
                        </span>
                    </a>
                </li>
                
                <!-- Menu Item: Kunjungan Harian -->
                <li>
                    <a href="{{ route('admin.kunjungan-harian.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.kunjungan-harian.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.kunjungan-harian.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                            class="menu-item-text">
                            Kunjungan Harian
                        </span>
                    </a>
                </li>

                <!-- Menu Item: Kunjungan Member -->
                <li>
                    <a href="{{ route('admin.kunjungan-member.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.kunjungan-member.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.kunjungan-member.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <!-- Icon Checklist Circle -->
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                            class="menu-item-text">
                            Kunjungan Member
                        </span>
                    </a>
                </li>
                
                <!-- Menu Item: Jadwal Latihan -->
                <li>
                    <a href="{{ route('admin.jadwal-latihan.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.jadwal-latihan.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.jadwal-latihan.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <!-- Icon List/Menu -->
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                            class="menu-item-text">
                            Jadwal Latihan
                        </span>
                    </a>
                </li>

                {{-- Menu Item: Laporan --}}
                <li>
                    <a href="{{ route('admin.laporan.index') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.laporan.*') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.laporan.*') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                            class="menu-item-text">
                            Laporan
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="$store.sidebar.isMobileOpen" @click="$store.sidebar.setMobileOpen(false)"
    class="fixed z-50 h-screen w-full bg-gray-900/50"></div>