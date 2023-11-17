<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompdecAnexo extends Model
{
    protected $table = 'com_anexo';
    protected $primaryKey = 'id';

    protected $fillable = [ 
                            'arquivo',
                            'descricao',
                            'id_municipio',
                            'nome',
    ];

    use HasFactory;

}
