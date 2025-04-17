@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Pengajuan Surat</h2>
    
    <form action="{{ route('pengajuan_surat.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis_surat" class="form-label">Jenis Surat</label>
            <select class="form-control" id="jenis_surat" name="jenis_surat" required>
                <option value="Surat Keterangan Mahasiswa">Surat Keterangan Mahasiswa</option>
                <option value="Surat Aktif Kuliah">Surat Aktif Kuliah</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Surat</button>
    </form>
</div>
@endsection
