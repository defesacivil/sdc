<?php

namespace App\Models\Compdec;

use App\Models\Municipio\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Interdicao extends Model
{
    protected $table = 'com_interdicao';
    protected $primaryKey = 'id';
    
    use HasFactory;


    /**
     * Get the user associated with the Vistoria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio(): HasOne
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }
}
