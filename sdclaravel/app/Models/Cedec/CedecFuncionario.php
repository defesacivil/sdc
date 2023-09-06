<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedecFuncionario extends Model
{
    protected $table = 'cedec_funcionario';
    protected $primaryKey = 'id';
    use HasFactory;
}
