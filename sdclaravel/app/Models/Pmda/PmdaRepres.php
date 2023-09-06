<?php

namespace App\Models\Pmda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmdaRepres extends Model
{
    protected $table = 'pip_pmda_representante';
    protected $primaryKey = 'id';
    use HasFactory;
}
