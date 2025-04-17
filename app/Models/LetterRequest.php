<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'letter_type_id',
        'description',
        'status',
    ];        

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    
    public function letterType()
    {
        return $this->belongsTo(LetterType::class);
    }

    public function uploadedDocument()
    {
        return $this->hasOne(UploadedDocument::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }    
}
