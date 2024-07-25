<?php

namespace App\Models\Voluntario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voluntario extends Model
{
    protected $table = 'cedec_voluntario';
    protected $primaryKey = 'id';
    
    use HasFactory;
}
