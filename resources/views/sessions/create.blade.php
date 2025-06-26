@extends('layouts.index')

@section('content')
<div class="container">
  <h4>Tambah Sesi untuk Event: {{ $event->name }}</h4>

  <form method="POST" action="{{ route('panitia.sessions.store', $event->id) }}">
    @csrf
    <div class="mb-3">
      <label>Judul Sesi</label>
      <input type="text" name="title" class="form-control" placeholder="Sesi 1 / Sesi 2 / Sesi 3" required>
    </div>

    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Waktu</label>
      <input type="time" name="waktu" class="form-control" required>
    </div>

    <button class="btn btn-success">Simpan Sesi</button>
  </form>
</div>
@endsection
