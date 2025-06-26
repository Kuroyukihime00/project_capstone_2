@extends('layouts.index')

@section('content')
<div class="container mt-4">
  <h4 class="mb-4">Upload Bukti Pembayaran</h4>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($registrations->isEmpty())
    <div class="alert alert-warning">
      Kamu belum mendaftar event apa pun atau semua pembayaran sudah diunggah.
    </div>
  @else
    <form action="{{ route('member.payments.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="event_registration_id" class="form-label">Pilih Event yang Sudah Didaftarkan</label>
        <select name="event_registration_id" class="form-select" required>
          <option value="">-- Pilih Event --</option>
          @foreach($registrations as $registration)
            <option value="{{ $registration->id }}">
              {{ $registration->event->name }} - Status: {{ ucfirst($registration->payment_status ?? 'belum') }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="payment_proof" class="form-label">Upload Bukti Pembayaran (PDF/JPG/PNG)</label>
        <input type="file" name="payment_proof" class="form-control" required accept=".pdf,.jpg,.jpeg,.png">
      </div>

      <button type="submit" class="btn btn-success">Upload</button>
    </form>
  @endif
</div>
@endsection
