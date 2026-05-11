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

   

    <a href="{{ route('user.dashboard') }}" class="flex items-center">

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

{{-- Menu khusus Member (User) --}}
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
            </ul>

        </nav>

    </div>

</aside>



<!-- Mobile Overlay -->

<div x-show="$store.sidebar.isMobileOpen" @click="$store.sidebar.setMobileOpen(false)"

    class="fixed z-50 h-screen w-full bg-gray-900/50"></div>