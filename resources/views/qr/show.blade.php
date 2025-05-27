@extends('layouts.index')

@section('content')
<div class="container text-center">
  <div class="page-inner">
    <h4>QR Code Kehadiran</h4>
    <p>Tunjukkan QR ini kepada panitia saat hadir.</p>
    <div>
      <img src="{{ $qr }}" alt="QR Code" class="img-fluid mt-3" style="max-width: 250px;">
    </div>
  </div>
</div>
@endsection
