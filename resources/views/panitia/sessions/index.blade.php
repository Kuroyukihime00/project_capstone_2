@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h4>Daftar Sesi dari Event Kamu</h4>

    @foreach($events as $event)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
            <a href="{{ route('panitia.sessions.create', $event->id) }}" class="btn btn-primary btn-sm mb-2">
                <i class="fa fa-plus"></i> Tambah Sesi
            </a>

            @if ($event->sessions->count())
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->sessions as $session)
                        <tr>
                            <td>{{ $session->title }}</td>
                            <td>{{ $session->tanggal }}</td>
                            <td>{{ $session->waktu }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Belum ada sesi untuk event ini.</p>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
