<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherUsers extends Model
{
    use HasFactory;
    protected $table = 'otherusers';
    public $timestamps = false;
}
