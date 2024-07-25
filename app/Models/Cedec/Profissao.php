<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissao extends Model
{
    protected $table = 'cedec_profissaos';
    protected $primaryKey = 'id';
    use HasFactory;
}
