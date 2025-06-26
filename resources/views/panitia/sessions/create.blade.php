@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>Tambah Sesi untuk Event: {{ $event->name }}</h4>

    <form action="{{ route('panitia.sessions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="event_id" value="{{ $event->id }}">

        <div class="mb-3">
            <label class="form-label">Judul Sesi</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="time" name="waktu" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
