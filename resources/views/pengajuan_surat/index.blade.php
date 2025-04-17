@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pengajuan Surat</h2>
    
    <a href="{{ route('pengajuan_surat.create') }}" class="btn btn-success mb-3">Buat Pengajuan Baru</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Surat</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuan as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->jenis_surat }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>
                    @if($item->status == 'pending')
                        <form action="{{ route('pengajuan_surat.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Batalkan</button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Diproses</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
