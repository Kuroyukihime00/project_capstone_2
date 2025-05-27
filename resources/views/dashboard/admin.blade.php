@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard Admin</h4>
    </div>

    <div class="row">

      {{-- Total Pengguna --}}
      <div class="col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-info">
                  <i class="fa fa-users"></i>
                </div>
              </div>
              <div class="col col-stats">
                <div class="numbers">
                  <p class="card-category">Total Pengguna</p>
                  <h4 class="card-title">{{ \App\Models\User::count() }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Total Event --}}
      <div class="col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-primary">
                  <i class="fa fa-calendar-alt"></i>
                </div>
              </div>
              <div class="col col-stats">
                <div class="numbers">
                  <p class="card-category">Total Event</p>
                  <h4 class="card-title">{{ \App\Models\Event::count() }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Jumlah Panitia --}}
      <div class="col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-icon">
                <div class="icon-big text-center icon-success">
                  <i class="fa fa-user-tie"></i>
                </div>
              </div>
              <div class="col col-stats">
                <div class="numbers">
                  <p class="card-category">Panitia Terdaftar</p>
                  <h4 class="card-title">
                    {{ \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'panitia'))->count() }}
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
