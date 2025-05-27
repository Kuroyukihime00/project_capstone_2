@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Sertifikat Saya</h4>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Event</th>
          <th>Tanggal</th>
          <th>Unduh</th>
        </tr>
      </thead>
      <tbody>
        @foreach($certificates as $cert)
        <tr>
          <td>{{ $cert->event->name }}</td>
          <td>{{ $cert->event->tanggal }}</td>
          <td>
            <a href="{{ route('certificates.download', $cert->event_registration_id) }}" class="btn btn-sm btn-success">
              <i class="fa fa-download"></i> Download
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
