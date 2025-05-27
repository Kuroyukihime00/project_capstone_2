<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['event_registration_id'];

    public function registration()
    {
        return $this->belongsTo(EventRegistration::class);
    }
}
