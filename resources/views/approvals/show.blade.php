@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Detail Pengajuan Surat</h2>
    <p><strong>Mahasiswa:</strong> {{ $request->student?->user?->name ?? '-' }}</p>
    <p><strong>Jenis Surat:</strong> {{ $request->letterType->name }}</p>
    <p><strong>Status:</strong> {{ $request->status }}</p>
    <p><strong>Deskripsi:</strong> {{ $request->description }}</p>

    <form method="POST" action="{{ route('approvals.approve', $request->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">Setujui</button>
    </form>

    <form method="POST" action="{{ route('approvals.reject', $request->id) }}">
        @csrf
        <textarea name="rejection_reason" form="reject-form" class="form-control mb-2" placeholder="Alasan Penolakan"></textarea>

        <div class="d-flex gap-2">
            <form id="reject-form" method="POST" action="{{ route('approvals.reject', $request->id) }}">
                @csrf
                <button type="submit" class="btn btn-danger">Tolak</button>
            </form>

            <a href="{{ route('approvals.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
