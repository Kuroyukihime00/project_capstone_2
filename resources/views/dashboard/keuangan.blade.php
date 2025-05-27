@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Dashboard Keuangan</h4>

    @php
      use App\Models\EventRegistration;
      $pending = EventRegistration::with('event', 'user')->where('status', 'pending')->get();
    @endphp

    <h6 class="mt-3">Verifikasi Pembayaran Pending</h6>
    <table class="table table-bordered mt-2">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Event</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pending as $reg)
        <tr>
          <td>{{ $reg->user->name }}</td>
          <td>{{ $reg->event->name }}</td>
          <td>
            <form method="POST" action="{{ route('keuangan.registrations.verify', $reg->id) }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">Verifikasi</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection