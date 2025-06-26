
@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Pilih Sesi Event</h4>
    <form action="{{ route('member.events.register', $event->id) }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="session_id">Pilih Sesi:</label>
        <select name="session_id" id="session_id" class="form-control" required>
          @foreach ($event->sessions as $session)
            <option value="{{ $session->id }}">
              {{ $session->nama_sesi }} - {{ $session->tanggal_sesi }} ({{ $session->waktu_mulai }} - {{ $session->waktu_selesai }})
            </option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Daftar</button>
    </form>
  </div>
</div>
@endsection
