@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Selamat datang, {{ auth()->user()->name }}</h4>
    <p>Silakan akses menu Event, Pembayaran, atau Sertifikat dari sidebar.</p>
  </div>
</div>
@endsection
