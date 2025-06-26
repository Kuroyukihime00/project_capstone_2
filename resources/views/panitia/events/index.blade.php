@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Daftar Event</h4>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Lokasi</th>
          <th>Biaya</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($events as $event)
        <tr>
          <td>{{ $event->name }}</td>
          <td>{{ $event->tanggal }}</td>
          <td>{{ $event->lokasi }}</td>
          <td>Rp {{ number_format($event->biaya) }}</td>
          <td>
            <a href="{{ route('member.events.register', $event->id) }}" class="btn btn-sm btn-primary">Daftar</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
