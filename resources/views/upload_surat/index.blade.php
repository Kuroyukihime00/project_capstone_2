@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Unggah Surat yang Sudah Disetujui</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Mahasiswa</th>
                <th>Jenis Surat</th>
                <th>Keterangan</th>
                <th>Upload File</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuan as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->mahasiswa->nama }}</td>
                <td>{{ $item->jenis_surat }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <form action="{{ route('upload_surat.upload', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file_surat" required>
                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
