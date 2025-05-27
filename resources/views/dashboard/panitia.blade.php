@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Dashboard Panitia</h4>

    @php
      use App\Models\Event;
      use App\Models\EventRegistration;
      use App\Models\Attendance;
      use App\Models\Certificate;

      $events = Event::latest()->get();
    @endphp

    <div class="row">
      @foreach($events as $event)
        @php
          $terdaftar = EventRegistration::where('event_id', $event->id)->count();
          $registrationIds = EventRegistration::where('event_id', $event->id)->pluck('id');
          $hadir = \App\Models\Attendance::whereIn('event_registration_id', $registrationIds)->count();
        @endphp

        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title">{{ $event->name }}</h5>
              <p class="mb-1"><strong>Tanggal:</strong> {{ $event->tanggal }}</p>
              <p class="mb-1"><strong>Peserta Terdaftar:</strong> {{ $terdaftar }}</p>
              <p class="mb-2"><strong>Peserta Hadir:</strong> {{ $hadir }}</p>

              @php
                $belumUpload = \App\Models\Attendance::whereIn('event_registration_id', $registrationIds)
                    ->whereNull('file_path')
                    ->exists();
              @endphp

              @if($belumUpload)
                <a href="{{ route('panitia.certificate.create', ['registration' => $event->id]) }}" class="btn btn-sm btn-primary">
                  <i class="fa fa-upload"></i> Upload Sertifikat
                </a>
              @else
                <span class="badge bg-success">Sertifikat Lengkap</span>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
