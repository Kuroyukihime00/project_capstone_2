<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'letter_request_id',
        'file_path'
    ];

    public function letterRequest()
    {
        return $this->belongsTo(LetterRequest::class);
    }    
}
