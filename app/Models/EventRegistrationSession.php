<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistrationSession extends Model
{
    protected $table = 'event_registration_session';
    
    protected $fillable = [
        'event_registration_id',
        'event_session_id',
        'attended', // boolean: apakah sudah hadir
    ];

    public $timestamps = false;

    public function registration()
    {
        return $this->belongsTo(EventRegistration::class, 'event_registration_id');
    }

    public function session()
    {
        return $this->belongsTo(EventSession::class, 'event_session_id');
    }
}
