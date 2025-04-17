
<header class="bg-light p-3 mb-4" style="margin-left: 220px;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Selamat datang, {{ Auth::user()->name }}</h5>
        <span class="text-muted">{{ now()->format('d M Y') }}</span>
    </div>
</header>
