<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
