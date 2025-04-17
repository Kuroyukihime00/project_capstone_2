@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Surat (Pending)</h2>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
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
                <td>{{ $request->student && $request->student->user ? $request->student->user->name : '-' }}</td>
                <td>{{ $request->letterType->name ?? '-' }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <a href="{{ route('approvals.show', $request->id) }}" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
