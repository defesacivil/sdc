<?php

namespace App\Models\Drrd;

use App\Models\Compdec\ComRegiao;
use App\Models\Municipio\Municipio;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaeEmpnto extends Model
{
    protected $table = 'pae_empntos';
    protected $fillable = ['municipio_id',
                             'pae_empdor_id', 
                             'regiao_id',
                              'nome',
                              'm_construcao',
                              'pae_coordenador_id',
                              'coordendor',
                              'tel_coordenador',
                            ];
    protected $primaryKey = 'id';
    use HasFactory;


    //MUNICIPIO
    public function municipio(){
        return $this->belongsTo(Municipio::class, 'municipio_id');

    }

    //REGIAO
    public function regiao(){

        return $this->belongsTo(ComRegiao::class, 'regiao_id');   
    }


    // COORDENADOR
    public function coordenador() {
        return $this->belongsTo(PaeCoord::class, 'pae_coordenador_id');

    }

    // EMPREENDEDOR
    public function empreendedor(){
        return $this->belongsTo(PaeEmpdor::class, 'pae_empdor_id');

    }


}
