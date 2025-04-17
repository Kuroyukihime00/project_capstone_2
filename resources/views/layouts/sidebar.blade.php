@php
    $role = auth()->user()->role->name ?? '';
    $currentRoute = Route::currentRouteName();
    $pendingCount = \App\Models\LetterRequest::where('status', 'pending')->count();
@endphp

<aside class="sidebar bg-dark text-white p-3" style="min-height: 100vh; width: 220px; float: left;">
    <h4 class="text-white">KaiAdmin</h4>
    <ul class="nav flex-column mt-4">
        {{-- Dashboard --}}
        <li class="nav-item">
            <a class="nav-link text-white {{ $currentRoute === 'dashboard' ? 'fw-bold' : '' }}" href="{{ route('dashboard') }}">
                <i class="fa fa-home me-2"></i> Dashboard
            </a>
        </li>

        {{-- Profil --}}
        <li class="nav-item">
            <a class="nav-link text-white {{ $currentRoute === 'profile.edit' ? 'fw-bold' : '' }}" href="{{ route('profile.edit') }}">
                <i class="fa fa-user me-2"></i> Profil
            </a>
        </li>

        {{-- Role Admin --}}
        @if($role === 'admin')
            <li class="nav-item">
                <a class="nav-link text-white {{ str_contains($currentRoute, 'employee') ? 'fw-bold' : '' }}" href="{{ route('admin.employee.index') }}">
                    <i class="fa fa-users me-2"></i> Employee
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ str_contains($currentRoute, 'lecturer') ? 'fw-bold' : '' }}" href="{{ route('admin.lecturer.index') }}">
                    <i class="fa fa-chalkboard-teacher me-2"></i> Lecturer
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ str_contains($currentRoute, 'student') ? 'fw-bold' : '' }}" href="{{ route('admin.student.index') }}">
                    <i class="fa fa-graduation-cap me-2"></i> Student
                </a>
            </li>
        @endif

        {{-- Role Mahasiswa --}}
        @if($role === 'mahasiswa')
            <li class="nav-item">
                <a class="nav-link text-white {{ str_contains($currentRoute, 'letter-requests') ? 'fw-bold' : '' }}" href="{{ route('student.letter-requests.index') }}">
                    <i class="fa fa-envelope me-2"></i> Pengajuan Surat
                </a>
            </li>
        @endif

        {{-- Role Kaprodi --}}
        @if($role === 'kaprodi')
            <li class="nav-item">
                <a class="nav-link text-white {{ request()->routeIs('approvals.*') ? 'active' : '' }}" href="{{ route('approvals.index') }}">
                    <i class="fa fa-check-square"></i> Persetujuan Surat
                    @if ($pendingCount > 0)
                        <span class="badge bg-danger">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
        @endif

        {{-- Role Manajer --}}
        @if($role === 'manajer')
            <li class="nav-item">
                <a class="nav-link text-white {{ str_contains($currentRoute, 'uploads') ? 'fw-bold' : '' }}" href="{{ route('uploads.index') }}">
                    <i class="fa fa-upload me-2"></i> Upload Surat
                </a>
            </li>
        @endif

        {{-- Logout --}}
        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link btn btn-link text-white">
                    <i class="fa fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</aside>
