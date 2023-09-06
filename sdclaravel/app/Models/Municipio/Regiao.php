<?php

namespace App\Models\Municipio;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{

    protected $table = 'com_regiaos';
    protected $primaryKey = 'id';

    use HasFactory;
}
