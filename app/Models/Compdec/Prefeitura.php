<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefeitura extends Model
{
    protected $table = 'cedec_prefeitura';
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = [
        'fotoPref',
        'latitude',
        'longitude',
        'latitude_dec',
        'longitude_dec',
        'distancia_bh',
        'populacao',
        'area',
        'pop_rural',
        'endereco',
        'bairro',
        'cep',
        'email_prefeitura',
        'fax_prefeitura',
        'tel_prefeitura',
        'num_lei',
        'dt_lei',
        'num_decreto',
        'dt_decreto',
        'num_portaria',
        'dt_portaria'
    ];
}
