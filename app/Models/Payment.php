<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['event_registration_id', 'proof_path', 'status'];

    public function registration()
    {
        return $this->belongsTo(EventRegistration::class);
    }
}
