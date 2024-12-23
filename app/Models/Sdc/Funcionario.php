<?php

namespace App\Models\Sdc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $connection = 'sdc';
    protected $table = 'cedec_funcionario';
    protected $primaryKey = 'id_funcionario';
    use HasFactory;
}
