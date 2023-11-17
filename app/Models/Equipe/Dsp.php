<?php

namespace App\Models\Equipe;

use App\Models\Municipio\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dsp extends Model
{
    protected $table = 'equ_reg_dsp';
    /*protected $fillable = ['id',
                             
                            
                            ];*/
    protected $primaryKey = 'id';
    
    use HasFactory;


    /**
     * Get all of the comments for the Dsp
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class, 'id', 'municipio_id');
    }



}
