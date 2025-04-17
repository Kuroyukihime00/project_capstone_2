@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard Kaprodi</h4>
    </div>
    <div class="card">
      <div class="card-body">
        <p>Halo, {{ auth()->user()->name }}!</p>
        <p>Silakan tinjau dan proses pengajuan surat dari mahasiswa melalui menu <strong>Persetujuan Surat</strong>.</p>
      </div>
    </div>
  </div>
</div>
@endsection
