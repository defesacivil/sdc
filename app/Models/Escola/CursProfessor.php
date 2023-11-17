<?php

namespace App\Models\Escola;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursProfessor extends Model
{

    protected $table = 'aju_professors';
    protected $primaryKey = 'id';
    use HasFactory;
}
