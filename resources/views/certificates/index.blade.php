@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Daftar Sertifikat</h4>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Event</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($certificates as $certificate)
        <tr>
          <td>{{ $certificate->event->name }}</td>
          <td>
            <a href="{{ route('certificates.download', $certificate->event_registration_id) }}" class="btn btn-sm btn-info">Download</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
