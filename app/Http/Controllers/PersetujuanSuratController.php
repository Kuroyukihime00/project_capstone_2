<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use App\Models\PersetujuanSurat;
use Illuminate\Support\Facades\Auth;

class PersetujuanSuratController extends Controller
{
    // Menampilkan daftar pengajuan surat yang harus disetujui oleh ketua prodi
    public function index()
    {
        $pengajuan = PengajuanSurat::where('program_studi_id', Auth::user()->program_studi_id)
                                   ->where('status', 'diajukan')
                                   ->get();
        return view('persetujuan.index', compact('pengajuan'));
    }

    // Menyetujui pengajuan surat
    public function approve($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => 'disetujui']);

        PersetujuanSurat::create([
            'pengajuan_surat_id' => $id,
            'ketua_program_studi_id' => Auth::id(),
            'status' => 'disetujui',
            'komentar' => 'Surat telah disetujui.'
        ]);

        return redirect('/persetujuan-surat')->with('success', 'Surat telah disetujui.');
    }

    // Menolak pengajuan surat
    public function reject($id, Request $request)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => 'ditolak']);

        PersetujuanSurat::create([
            'pengajuan_surat_id' => $id,
            'ketua_program_studi_id' => Auth::id(),
            'status' => 'ditolak',
            'komentar' => $request->komentar
        ]);

        return redirect('/persetujuan-surat')->with('error', 'Surat telah ditolak.');
    }
}
