@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Upload Sertifikat Peserta</h4>
    <form method="POST" action="{{ route('certificate.store', $registration->id) }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="file">Sertifikat (.pdf)</label>
        <input type="file" name="file" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Upload</button>
    </form>
  </div>
</div>
@endsection
