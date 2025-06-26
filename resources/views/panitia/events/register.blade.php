@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner text-center">
    <h4>Registrasi Ulang</h4>
    <p>Silakan tunjukkan QR code Anda di bawah ini saat hadir di lokasi event.</p>

    <div class="mt-4">
      <img src="{{ $qr }}" alt="QR Code" class="img-thumbnail" style="max-width: 250px;">
    </div>

    <p class="mt-3">Event: <strong>{{ $event->name }}</strong><br>
    Lokasi: {{ $event->lokasi }}<br>
    Tanggal: {{ $event->tanggal }}</p>
  </div>
</div>
@endsection
