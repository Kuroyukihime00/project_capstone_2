@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>Daftar Sesi Semua Event</h4>
    <a href="{{ route('admin.sessions.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah Sesi
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Event</th>
                <th>Judul Sesi</th>
                <th>Tanggal</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sessions as $session)
            <tr>
                <td>{{ $session->event->name }}</td>
                <td>{{ $session->title }}</td>
                <td>{{ $session->tanggal }}</td>
                <td>{{ $session->waktu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
