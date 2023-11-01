<?php

namespace App\Models\Municipio;

//use App\Models\Drrd\PaeEmpnto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Municipio extends Model
{
    protected $table = 'cedec_municipio';
    protected $primaryKey = 'id';

    protected $fillable =   [
        'cobra_iss',
        'resp_cob_iss',
        'num_lei_iss',
        'aliquota_iss',
    ];
    
    use HasFactory;


    //MUNICIPIO
    /*public function empreendimento(){
        return $this->hasOne(PaeEmpnto::class, 'municipio_id');

    }*/

    
    
    
    /**
     * Get the user associated with the AjudaPedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CedecRdc(): HasOne
    {
        return $this->hasOne(CedecRdc::class, 'id', 'rdc_id');
    }
    
}