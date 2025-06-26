@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>Detail Kehadiran Peserta</h4>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Peserta:</strong> {{ $registration->user->name }}</p>
            <p><strong>Event:</strong> {{ $registration->event->name }}</p>
            <p><strong>Sesi Dipilih:</strong> {{ $registration->session->title ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $registration->session->tanggal ?? '-' }}</p>
            <p><strong>Waktu:</strong> {{ $registration->session->waktu ?? '-' }}</p>
            <p><strong>Status:</strong> Hadir</p>
            <a href="{{ route('panitia.dashboard') }}" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</div>
@endsection
