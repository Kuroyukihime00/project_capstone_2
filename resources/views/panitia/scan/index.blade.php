@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <h4>Daftar Registrasi untuk Scan QR</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Peserta</th>
                    <th>Event</th>
                    <th>Sesi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $reg)
                <tr>
                    <td>{{ $reg->user->name }}</td>
                    <td>{{ $reg->event->name }}</td>
                    <td>{{ $reg->session->title ?? '-' }}</td>
                    <td>
                        <a href="{{ route('panitia.scan', $reg->id) }}" class="btn btn-primary btn-sm">
                            Scan Hadir
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
