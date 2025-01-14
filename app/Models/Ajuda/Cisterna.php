<?php

namespace App\Models\Ajuda;

use App\Models\Municipio\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cisterna extends Model
{

    protected $table = 'sinc_cisterna';
    protected $primaryKey = 'id';

    //protected $guarded = ['cisterna_id'];
    
    use HasFactory;

    /**
     * Get the user associated with the Municipío
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getMunicipio(): HasOne
    {
        return $this->hasOne(Municipio::class, 'Codmundv', 'municipio');
    }



     
}
