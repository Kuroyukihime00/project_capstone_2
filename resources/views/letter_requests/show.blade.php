@extends('layouts.index')

@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="container">
    <h3 class="mb-4">Detail Pengajuan Surat</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Jenis Surat:</strong> {{ $letterRequest->letterType->name }}</p>
            <p><strong>Alasan:</strong> {{ $letterRequest->reason }}</p>
            <p><strong>Status:</strong>
                <span class="badge bg-{{ $letterRequest->status == 'approved' ? 'success' : ($letterRequest->status == 'rejected' ? 'danger' : 'warning') }}">
                    {{ ucfirst($letterRequest->status) }}
                </span>
            </p>
            <p><strong>Dibuat:</strong> {{ $letterRequest->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('student.letter-requests.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
