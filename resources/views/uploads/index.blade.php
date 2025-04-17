@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Surat Disetujui (Belum Diunggah)</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('download'))
        <script>
            window.onload = function() {
                const link = document.createElement('a');
                link.href = "{{ session('download') }}";
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            };
        </script>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Mahasiswa</th>
                <th>Jenis Surat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->student->user->name }}</td>
                <td>{{ $request->letterType->name }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <a href="{{ route('uploads.form', $request->id) }}" class="btn btn-primary btn-sm">Upload Surat</a>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
