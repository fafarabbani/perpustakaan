<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link title="Dashboard"
        href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('kasir.dashboard', Auth::user()) }}"
        :isActive="Auth::user()->role === 'admin' ? request()->routeIs('admin.dashboard') : request()->routeIs('kasir.dashboard', Auth::user())">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">
        {{ __('Menu') }}
    </div>

    {{--  Admin Links  --}}
    @if (Auth::user()->role === 'admin')
        <x-sidebar.dropdown
            title="Menu Master"
            :active="Str::startsWith(request()->route()->uri(), 'admin.anggota.*') || Str::startsWith(request()->route()->uri(), 'admin.buku.*')"
        >
            <x-slot name="icon">
                <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.sublink
                title="Anggota"
                href="{{ route('admin.anggota.index') }}"
                :active="request()->routeIs('admin.anggota.*')"
            />
            <x-sidebar.sublink
                title="Buku"
                href="{{ route('admin.buku.index') }}"
                :active="request()->routeIs('admin.buku.*')"
            />
        </x-sidebar.dropdown>
    @else (Auth::user()->role === 'kasir')
        <x-sidebar.dropdown
            title="Menu Transaksi"
            :active="Str::startsWith(request()->route()->uri(), 'kasir.peminjaman.*') || Str::startsWith(request()->route()->uri(), 'kasir.pengembalian.*')"
        >
            <x-slot name="icon">
                <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>

            <x-sidebar.sublink
                title="Peminjaman"
                href="{{ route('kasir.peminjaman.index') }}"
                :active="request()->routeIs('kasir.peminjaman.*')"
            />
            <x-sidebar.sublink
                title="Pengembalian"
                href="{{ route('kasir.pengembalian.index') }}"
                :active="request()->routeIs('kasir.pengembalian.*')"
            />
        </x-sidebar.dropdown>
    @endif

    {{--  <x-sidebar.dropdown
        title="Menu Master"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Anggota"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Buku"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
    </x-sidebar.dropdown>
    
    <x-sidebar.dropdown
        title="Menu Transaksi"
        :active="Str::startsWith(request()->route()->uri(), 'buttons')"
    >
        <x-slot name="icon">
            <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>

        <x-sidebar.sublink
            title="Peminjaman"
            href="{{ route('buttons.text') }}"
            :active="request()->routeIs('buttons.text')"
        />
        <x-sidebar.sublink
            title="Pengembalian"
            href="{{ route('buttons.icon') }}"
            :active="request()->routeIs('buttons.icon')"
        />
    </x-sidebar.dropdown>  --}}


</x-perfect-scrollbar>
