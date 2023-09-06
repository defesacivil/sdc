<?php

namespace App\Models\Pmda;

use App\Models\Municipio\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PmdaPonto extends Model
{
    protected $table = 'pip_pmda_ponto';
    protected $primaryKey = 'id';
    use HasFactory;


    public function pontos(): BelongsToMany
    {
        return $this->belongsToMany(PmdaPmdaPonto::class, 'pip_pmda_pmdaponto', 'pmda_id', 'ponto_id');
    }
   
    /**
     * Get the user associated with the PmdaPonto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio(): HasOne
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }
}
