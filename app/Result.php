<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['matric_no', 'course_code', 'test', 'exam', 'semester', 'session'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
