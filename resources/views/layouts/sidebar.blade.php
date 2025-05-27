@php
    $role = auth()->user()->role->name ?? '';
    $currentRoute = Route::currentRouteName();
@endphp

<aside class="sidebar bg-dark text-white p-3" style="min-height: 100vh; width: 220px; float: left;">
    <h4 class="text-white">KaiAdmin</h4>
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link text-white {{ $currentRoute === 'dashboard' ? 'fw-bold' : '' }}" href="{{ route('dashboard') }}">
                <i class="fa fa-home me-2"></i> Dashboard
            </a>
        </li>

        @if ($role === 'admin')
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'admin.users') ? 'fw-bold' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fa fa-user-cog me-2"></i> Kelola Pengguna
            </a>
        </li>
        @endif

        @if ($role === 'member')
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'member.events') ? 'fw-bold' : '' }}" href="{{ route('member.events.index') }}">
                <i class="fa fa-calendar me-2"></i> Event
            </a>
        </li>
        @endif

        @if ($role === 'panitia')
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'panitia.scan') ? 'fw-bold' : '' }}" href="{{ route('panitia.dashboard') }}">
                <i class="fa fa-qrcode me-2"></i> Scan QR
            </a>
        </li>
        @endif
    </ul>
</aside>
