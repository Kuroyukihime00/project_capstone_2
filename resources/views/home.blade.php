@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Selamat Datang di Sistem Pengajuan Surat</h2>
    <p>Silakan gunakan menu navigasi untuk mengakses fitur yang tersedia.</p>

    @if(Auth::user()->hasRole('mahasiswa'))
        <a href="{{ route('pengajuan_surat.index') }}" class="btn btn-primary">Ajukan Surat</a>
    @elseif(Auth::user()->hasRole('ketua_prodi'))
        <a href="{{ route('persetujuan_surat.index') }}" class="btn btn-warning">Persetujuan Surat</a>
    @elseif(Auth::user()->hasRole('manajer_operasional') || Auth::user()->hasRole('tata_usaha'))
        <a href="{{ route('upload_surat.index') }}" class="btn btn-success">Unggah Surat</a>
    @endif
</div>
@endsection
