@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Upload Surat</h2>
    <p><strong>Mahasiswa:</strong> {{ $request->student->user->name }}</p>
    <p><strong>Jenis Surat:</strong> {{ $request->letterType->name }}</p>

    <form method="POST" action="{{ route('uploads.upload', $request->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="document" class="form-label">File Surat (PDF):</label>
            <input type="file" name="document" id="document" class="form-control" required>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Unggah</button>
            <a href="{{ route('uploads.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </form>
</div>
@endsection
