<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
  protected $table = 'students';

  protected $fillable = ['nrp', 'name', 'email', 'address', 'phone', 'birth_date', 'profile_picture', 'lecturer_nik'];

  protected $primaryKey = 'nrp';

  public $incrementing = false;

  protected $keyType = 'string';

  public function academicSupervisor(): BelongsTo
  {
    return $this->belongsTo(Lecturer::class, 'lecturer_nik');
  }

  public function user()
  {
      return $this->belongsTo(User::class, 'nrp', 'nip');
  }  
}
