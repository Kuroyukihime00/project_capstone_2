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
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'member.payments') ? 'fw-bold' : '' }}" href="{{ route('member.payments.create', ['registration' => 1]) }}">
            <i class="fa fa-credit-card me-2"></i> Pembayaran
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'member.certificates') ? 'fw-bold' : '' }}" href="{{ route('member.certificates.show') }}">
            <i class="fa fa-file-alt me-2"></i> Sertifikat
            </a>
        </li>
        @endif

        @if ($role === 'panitia')
        <li class="nav-item">
            <a class="nav-link text-white {{ $currentRoute === 'panitia.scan.index' ? 'fw-bold' : '' }}" href="{{ route('panitia.scan.index') }}">
                <i class="fa fa-qrcode me-2"></i> Scan QR
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'panitia.events.create') ? 'fw-bold' : '' }}" href="{{ route('panitia.events.create') }}">
                <i class="fa fa-plus me-2"></i> Tambah Event
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white {{ str_contains($currentRoute, 'panitia.sessions') ? 'fw-bold' : '' }}" href="{{ route('panitia.sessions.index') }}">
                <i class="fa fa-clock me-2"></i> Kelola Sesi
            </a>
        </li>
        @endif
    </ul>
</aside>
