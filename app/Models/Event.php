<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'tanggal', 'waktu', 'lokasi', 'narasumber', 'poster', 'biaya', 'max_peserta'
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
