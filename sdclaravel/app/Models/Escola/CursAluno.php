<?php

namespace App\Models\Escola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursAluno extends Model
{
    protected $table = 'esc_alunos';
    protected $primaryKey = 'id';
    use HasFactory;
}
