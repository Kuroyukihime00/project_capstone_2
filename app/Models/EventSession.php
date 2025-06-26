<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    protected $fillable = ['event_id', 'title', 'tanggal', 'waktu'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrations()
    {
        return $this->belongsToMany(EventRegistration::class, 'event_registration_session')
            ->withPivot('attended');
    }
}
