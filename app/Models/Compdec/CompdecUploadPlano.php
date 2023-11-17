<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompdecUploadPlano extends Model
{
    protected $table = 'com_plano_upload';
    protected $primaryKey = 'id';

    protected $fillable =   [
            'file_plano',
            'versao',
            'tamanho',
            'obs',
    ];
    use HasFactory;
}
