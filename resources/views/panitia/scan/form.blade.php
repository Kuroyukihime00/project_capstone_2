@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Scan QR Manual</h4>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('scan.submit') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="registration_id">Masukkan ID Registrasi</label>
        <input type="text" class="form-control" id="registration_id" name="registration_id" required>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Scan</button>
    </form>
  </div>
</div>
@endsection
