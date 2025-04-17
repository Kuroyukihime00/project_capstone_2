@extends('layouts.index')

@section('title', 'Daftar Pengajuan Surat')

@section('content')
<div class="container">
    <h3 class="mb-4">Daftar Pengajuan Surat</h3>

    <a href="{{ route('student.letter-requests.create') }}" class="btn btn-primary mb-3">+ Ajukan Surat</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis Surat</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requests as $req)
                <tr>
                    <td>{{ $req->letterType->name }}</td>
                    <td>{{ $req->reason }}</td>
                    <td>
                        <span class="badge bg-{{ $req->status == 'approved' ? 'success' : ($req->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($req->status) }}
                        </span>
                    </td>
                    <td>{{ $req->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('student.letter-requests.show', $req->id) }}" class="btn btn-sm btn-info">Detail</a>
                        <form action="{{ route('student.letter-requests.destroy', $req->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus surat ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada pengajuan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
