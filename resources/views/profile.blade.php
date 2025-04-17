@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title"><i class="fas fa-user"></i> Profil Pengguna</h4>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h5 class="mb-3"><strong>Nama:</strong> {{ auth()->user()->name }}</h5>
            <h5 class="mb-3"><strong>Email:</strong> {{ auth()->user()->email }}</h5>
            <h5 class="mb-3"><strong>NIP:</strong> {{ auth()->user()->nip }}</h5>
            <h5 class="mb-0"><strong>Role:</strong> {{ auth()->user()->role->name ?? '-' }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
