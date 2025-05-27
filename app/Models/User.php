<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\EventRegistration;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'nip', 'password', 'role_id'];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
    
    public function eventRegistrations()
    {
        return $this->hasMany(\App\Models\EventRegistration::class);
    }
}
