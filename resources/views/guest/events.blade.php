@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Daftar Event Terbuka</h4>
    <div class="row">
      @foreach($events as $event)
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
            <p><strong>Tanggal:</strong> {{ $event->tanggal }}</p>
            <p><strong>Waktu:</strong> {{ $event->waktu }}</p>
            <p><strong>Lokasi:</strong> {{ $event->lokasi }}</p>
            <p><strong>Biaya:</strong> Rp{{ number_format($event->biaya, 0, ',', '.') }}</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Daftar</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
