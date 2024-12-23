<?php

namespace App\Models\Sdc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $connection = 'sdc';
    protected $table = 'cedec_usuario';
    protected $primaryKey = 'id_usuario';

    use HasFactory;
}
