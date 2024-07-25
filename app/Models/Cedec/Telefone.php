<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'cedec_telefone';
    protected $primaryKey = 'id';
    use HasFactory;
}
