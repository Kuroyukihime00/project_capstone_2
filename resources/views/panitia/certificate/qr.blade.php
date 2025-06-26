@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>QR Sertifikat untuk {{ $registration->user->name }}</h4>
    <p>Event: {{ $registration->event->name }}</p>
    <img src="{{ $qrData }}" alt="QR Code Sertifikat">
</div>
@endsection
