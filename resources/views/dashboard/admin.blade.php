@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard Admin</h4>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
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

      <!-- Tambahkan statistik lain sesuai kebutuhan -->
    </div>
  </div>
</div>
@endsection
