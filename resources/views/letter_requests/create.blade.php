@extends('layouts.index')

@section('title', 'Ajukan Surat')

@section('content')
<div class="container">
    <h3 class="mb-4">Ajukan Surat</h3>

    <form action="{{ route('student.letter-requests.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="letter_type_id" class="form-label">Jenis Surat</label>
            <select name="letter_type_id" id="letter_type_id" class="form-select" required>
                <option value="">-- Pilih Jenis Surat --</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Alasan</label>
            <textarea name="reason" id="reason" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
        <a href="{{ route('student.letter-requests.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
