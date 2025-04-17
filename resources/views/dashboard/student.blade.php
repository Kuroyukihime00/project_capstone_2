@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h4 class="page-title">Dashboard Mahasiswa</h4>
    </div>
    <div class="card">
      <div class="card-body">
        <p>Selamat datang, {{ auth()->user()->name }}!</p>
        <p>Kamu bisa melakukan pengajuan surat melalui menu <strong>Surat</strong>.</p>
      </div>
    </div>
  </div>
</div>
@endsection
