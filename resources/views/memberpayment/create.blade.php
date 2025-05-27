@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Upload Bukti Pembayaran</h4>
    <form method="POST" action="{{ route('member.payments.store', $registration->id) }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="proof">Bukti Pembayaran</label>
        <input type="file" name="proof" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success mt-2">Upload</button>
    </form>
  </div>
</div>
@endsection
