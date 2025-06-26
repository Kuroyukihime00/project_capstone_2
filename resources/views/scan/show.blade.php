@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>Scan QR - Detail Registrasi</h4>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Peserta:</strong> {{ $registration->user->name }}</p>
            <p><strong>Event:</strong> {{ $registration->event->name }}</p>
            <p><strong>Sesi Dipilih:</strong> {{ $registration->session->title ?? '-' }}</p>
            <p><strong>Tanggal Sesi:</strong> {{ $registration->session->tanggal ?? '-' }}</p>
            <p><strong>Waktu:</strong> {{ $registration->session->waktu ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($registration->status) }}</p>
        </div>
    </div>
</div>
@endsection
