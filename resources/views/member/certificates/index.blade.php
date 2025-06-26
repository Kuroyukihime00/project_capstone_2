@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Sertifikat Saya</h4>

    @if($certificates->isEmpty())
      <div class="alert alert-warning mt-3">
        Anda belum memiliki sertifikat.
      </div>
    @else
    <div class="row mt-3">
      @foreach($certificates as $cert)
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title">{{ $cert->registration->event->name }}</h5>
            <p class="card-text">
              Tanggal: {{ $cert->registration->event->tanggal }}<br>
              Sesi: {{ $cert->registration->session->title ?? '-' }}
            </p>
            <a href="{{ route('member.certificates.download', $cert->registration_id) }}" class="btn btn-sm btn-primary">
              <i class="fa fa-download me-1"></i> Unduh Sertifikat
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</div>
@endsection
