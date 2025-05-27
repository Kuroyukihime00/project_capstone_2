@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Hasil Scan Kehadiran</h4>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="GET" action="{{ route('panitia.scan', ['registration' => '']) }}">
      <div class="form-group">
        <label for="code">Masukkan ID Registrasi</label>
        <input type="text" name="registration" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success mt-2">Scan</button>
    </form>
  </div>
</div>
@endsection
