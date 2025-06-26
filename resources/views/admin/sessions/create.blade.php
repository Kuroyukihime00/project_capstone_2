@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>Tambah Sesi untuk Event</h4>
    <form action="{{ route('admin.sessions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="event_id" class="form-label">Event</label>
            <select name="event_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Event --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>
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
