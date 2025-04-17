@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard TU / Manajer</h4>
    </div>
    <div class="card">
      <div class="card-body">
        <p>Selamat datang, {{ auth()->user()->name }}!</p>
        <p>Silakan unggah surat yang telah disetujui melalui menu <strong>Upload Surat</strong>.</p>
      </div>
    </div>
  </div>
</div>
@endsection
