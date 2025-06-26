@extends('layouts.index')

@section('content')
<div class="container">
  <h4 class="mb-4">Registrasi untuk Event: {{ $event->name }}</h4>

  @if ($existing)
    <div class="alert alert-info">
      Kamu sudah terdaftar untuk event ini. Berikut adalah QR code kamu:
    </div>
    <img src="{{ $qrData }}" alt="QR Code" class="img-thumbnail">
  @else
    @if ($event->sessions->count())
      <form method="POST" action="{{ route('member.events.store') }}">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">

        <div class="mb-3">
          <label class="form-label"><strong>Pilih Sesi yang Ingin Diikuti:</strong></label>
          @foreach($event->sessions as $session)
            <div class="form-check">
              <input
                class="form-check-input"
                type="checkbox"
                name="sessions[]"
                value="{{ $session->id }}"
                id="session-{{ $session->id }}">
              <label class="form-check-label" for="session-{{ $session->id }}">
                {{ $session->title }} ({{ $session->tanggal }} {{ $session->waktu }}) <br>
                <small>Speaker: {{ $session->speaker }} | Harga: Rp{{ number_format($session->price, 0, ',', '.') }}</small>
              </label>
            </div>
          @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Daftar</button>
      </form>
    @else
      <p class="text-muted">Belum ada sesi untuk event ini.</p>
    @endif
  @endif
</div>
@endsection
