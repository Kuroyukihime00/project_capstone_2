@extends('layouts.index')

@section('content')
<div class="container">
    <h2>Detail Pengajuan Surat</h2>
    <p><strong>Mahasiswa:</strong> {{ $request->student->user->name }}</p>
    <p><strong>Jenis Surat:</strong> {{ $request->letterType->name }}</p>
    <p><strong>Status:</strong> {{ $request->status }}</p>
    <p><strong>Deskripsi:</strong> {{ $request->description }}</p>

    <form method="POST" action="{{ route('approvals.approve', $request->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">Setujui</button>
    </form>

    <form method="POST" action="{{ route('approvals.reject', $request->id) }}">
        @csrf
        <div class="form-group mt-3">
            <label>Alasan Penolakan:</label>
            <textarea name="rejection_reason" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-danger mt-2">Tolak</button>
    </form>
</div>
@endsection
