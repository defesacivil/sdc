<?php

namespace App\Models\Pmda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmdaComunidade extends Model
{
    protected $table = 'pip_comunidade';
    protected $primaryKey = 'id';
    use HasFactory;
}
