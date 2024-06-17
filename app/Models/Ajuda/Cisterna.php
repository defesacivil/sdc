<?php

namespace App\Models\Ajuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cisterna extends Model
{

    protected $table = 'aju_cisterna_cadastro';
    protected $primaryKey = 'id';
    
    use HasFactory;
}
