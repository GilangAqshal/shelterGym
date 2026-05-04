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
                    <a href="{{ route('admin.dashboard') }}"
                        class="menu-item group"
                        :class="[
                            {{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }} ? 'menu-item-active' : 'menu-item-inactive',
                            (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start'
                        ]">
                        
                        <span class="{{ request()->routeIs('admin.dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive' }}">
                            <!-- Icon Dashboard (Grid) -->
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 13H11V3H3V13ZM3 21H11V15H3V21ZM13 21H21V11H13V21ZM13 3V9H21V3H13Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                              class="menu-item-text">
                            Dashboard
                        </span>
                    </a>
                </li>

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

            </ul>
        </nav>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="$store.sidebar.isMobileOpen" @click="$store.sidebar.setMobileOpen(false)"
    class="fixed z-50 h-screen w-full bg-gray-900/50"></div>