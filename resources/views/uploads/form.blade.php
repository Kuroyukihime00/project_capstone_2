@extends('layouts.index')

@section('content')
<h2>Upload Dokumen Surat</h2>
<form method="POST" action="{{ route('uploads.upload', $request->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="file">Upload File PDF</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success mt-3">Upload</button>
</form>
@endsection
