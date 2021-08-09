<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsMarks extends Model
{
    protected $table = 'studentsmarks';
    public $timestamps = false;
    use HasFactory;
}
