@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard Member</h4>
    </div>

    {{-- Informasi Status Terakhir --}}
    @php
      $registration = auth()->user()->eventRegistrations()
          ->with(['payment', 'attendance', 'event'])
          ->latest()
          ->first();
    @endphp

    @if($registration)
    <div class="card mb-4">
      <div class="card-body">
        <h5 class="card-title">{{ $registration->event->name }}</h5>
        <p class="mb-1"><strong>Status Pembayaran:</strong>
          @if($registration->payment)
            {{ ucfirst($registration->payment->status) }}
          @else
            Belum ada pembayaran
          @endif
        </p>
        <p class="mb-0"><strong>Status Kehadiran:</strong>
          {{ $registration->attendance ? 'Hadir' : 'Belum Hadir' }}
        </p>
      </div>
    </div>
    @endif

    {{-- Shortcut Aksi --}}
    <div class="row">
      <div class="col-md-4">
        <a href="{{ route('member.events.index') }}" class="card card-outline-primary text-center p-3">
          <i class="fa fa-calendar fa-2x"></i>
          <h6 class="mt-2">Lihat Event</h6>
        </a>
      </div>
      <div class="col-md-4">
        <a href="{{ route('member.payments.create', ['registration' => 0]) }}" class="card card-outline-success text-center p-3">
          <i class="fa fa-upload fa-2x"></i>
          <h6 class="mt-2">Upload Pembayaran</h6>
        </a>
      </div>
      <div class="col-md-4">
        <a href="{{ route('member.certificates.show') }}" class="card card-outline-info text-center p-3">
          <i class="fa fa-file-download fa-2x"></i>
          <h6 class="mt-2">Download Sertifikat</h6>
        </a>
      </div>
    </div>

  </div>
</div>
@endsection
