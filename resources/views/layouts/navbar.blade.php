<ul>
    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
    @if(Auth::user()->role->nama_role == 'mahasiswa')
        <li><a href="{{ route('pengajuan_surat.index') }}">Pengajuan Surat</a></li>
    @elseif(Auth::user()->role->nama_role == 'ketua_prodi')
        <li><a href="{{ route('persetujuan_surat.index') }}">Persetujuan Surat</a></li>
    @elseif(in_array(Auth::user()->role->nama_role, ['manajer_operasional', 'tata_usaha']))
        <li><a href="{{ route('upload_surat.index') }}">Upload Surat</a></li>
    @endif
</ul>
