<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanSurat extends Model
{
    use HasFactory;

    protected $fillable = ['pengajuan_surat_id', 'ketua_program_studi_id', 'status_persetujuan_id', 'komentar'];

    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class);
    }

    public function ketuaProgramStudi()
    {
        return $this->belongsTo(User::class, 'ketua_program_studi_id');
    }

    public function statusPersetujuan()
    {
        return $this->belongsTo(StatusPersetujuan::class, 'status_persetujuan_id');
    }
}
