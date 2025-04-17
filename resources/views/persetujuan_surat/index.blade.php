@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Surat untuk Persetujuan</h2>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Mahasiswa</th>
                <th>Jenis Surat</th>
                <th>Keterangan</th>
                <th>Aksi</th>
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
                    <form action="{{ route('persetujuan_surat.approve', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                    </form>
                    <form action="{{ route('persetujuan_surat.reject', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
