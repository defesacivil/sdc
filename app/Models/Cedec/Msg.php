<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    use HasFactory;
    protected $table = 'cedec_mensagem';
    protected $primaryKey = 'id';

}
