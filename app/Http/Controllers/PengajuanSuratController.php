<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\JenisSurat;
use App\Models\StatusPengajuan;
use Illuminate\Http\Request;
use Auth;

class PengajuanSuratController extends Controller
{
    public function index()
    {
        $pengajuanSurat = PengajuanSurat::with('jenisSurat', 'statusPengajuan')
                            ->where('mahasiswa_id', Auth::id())
                            ->get();

        return view('pengajuan_surat.index', compact('pengajuanSurat'));
    }

    public function create()
    {
        $jenisSurat = JenisSurat::pluck('nama_jenis_surat', 'id');
        return view('pengajuan_surat.create', compact('jenisSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surat,id'
        ]);

        PengajuanSurat::create([
            'mahasiswa_id' => Auth::id(),
            'program_studi_id' => Auth::user()->program_studi_id,
            'jenis_surat_id' => $request->jenis_surat_id,
            'status_id' => 1 // Status "Diajukan"
        ]);

        return redirect()->route('pengajuan_surat.index')->with('success', 'Pengajuan berhasil dikirim!');
    }
}
