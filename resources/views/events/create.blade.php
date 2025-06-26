@extends('layouts.index')

@section('content')
<div class="container">
  <h4>Tambah Event</h4>
  <form method="POST" action="{{ route('panitia.events.store') }}">
    @csrf
    <div class="mb-3">
      <label>Nama Event</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Waktu</label>
      <input type="time" name="waktu" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Lokasi</label>
      <input type="text" name="lokasi" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Narasumber</label>
      <input type="text" name="narasumber" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Poster (nama file saja)</label>
      <input type="text" name="poster" class="form-control">
    </div>
    <div class="mb-3">
      <label>Biaya Registrasi</label>
      <input type="number" name="biaya" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Max Peserta</label>
      <input type="number" name="max_peserta" class="form-control" required>
    </div>
    <button class="btn btn-success">Simpan</button>
  </form>
</div>
@endsection
