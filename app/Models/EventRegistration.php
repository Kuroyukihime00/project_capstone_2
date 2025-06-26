<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = ['user_id', 'event_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function session()
    {
        return $this->belongsTo(\App\Models\EventSession::class);
    }

    public function sessions()
    {
        return $this->belongsToMany(EventSession::class, 'event_registration_session')
            ->withPivot('attended'); // untuk tanda kehadiran tiap sesi
    }
}
