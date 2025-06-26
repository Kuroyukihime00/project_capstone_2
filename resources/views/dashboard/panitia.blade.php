@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Dashboard Panitia</h4>

    @php
      use App\Models\Event;
      use App\Models\EventRegistration;
      use App\Models\Attendance;

      $events = Event::with('sessions')->latest()->get();
    @endphp

    <div class="row">
      @foreach($events as $event)
        @php
          $registrations = EventRegistration::with('session')
              ->where('event_id', $event->id)->get();

          $terdaftar = $registrations->count();
          $hadir = Attendance::whereIn('event_registration_id', $registrations->pluck('id'))->count();
        @endphp

        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">{{ $event->name }}</h5>
              <p class="mb-1"><strong>Tanggal:</strong> {{ $event->tanggal }}</p>
              <p class="mb-1"><strong>Peserta Terdaftar:</strong> {{ $terdaftar }}</p>
              <p class="mb-2"><strong>Peserta Hadir:</strong> {{ $hadir }}</p>

              <ul class="list-group list-group-flush">
                @foreach($registrations as $reg)
                  <li class="list-group-item">
                    {{ $reg->user->name }} -
                    Sesi: {{ $reg->session->title ?? 'Tidak memilih' }} <br>
                    <a href="{{ route('panitia.scan', $reg->id) }}" class="btn btn-sm btn-success mt-1">
                      Scan QR
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
