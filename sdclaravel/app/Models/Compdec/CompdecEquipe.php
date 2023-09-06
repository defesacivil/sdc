<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompdecEquipe extends Model
{
    protected $table = 'com_eq_comdec';
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = [
            'nome',
            'funcao',
            'telefone',
            'celular',
            'email',
    ];
}
