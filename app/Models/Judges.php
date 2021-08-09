<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judges extends Model
{
    use HasFactory;
    protected $table = 'judges';
    public $timestamps = false;

}
