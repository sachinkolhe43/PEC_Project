<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsMarks extends Model
{
    protected $table = 'projectmarks';
    public $timestamps = false;
    use HasFactory;
}
