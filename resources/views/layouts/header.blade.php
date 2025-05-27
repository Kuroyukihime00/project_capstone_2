<header class="bg-light p-3 mb-4" style="margin-left: 220px;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            @auth
                <h5 class="mb-0">Selamat datang, {{ Auth::user()->name }}</h5>
            @else
                <h5 class="mb-0">Selamat datang, Tamu</h5>
            @endauth
        </div>

        <div class="d-flex align-items-center gap-3">
            <span class="text-muted">{{ now()->format('d M Y') }}</span>

            @auth
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </button>
            </form>
            @endauth
        </div>
    </div>
</header>
