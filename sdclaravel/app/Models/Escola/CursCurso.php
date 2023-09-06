<?php

namespace App\Models\Escola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursCurso extends Model
{
    protected $table = 'aju_cursos';
    protected $primaryKey = 'id';
    use HasFactory;
}
