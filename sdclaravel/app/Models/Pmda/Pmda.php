<?php

namespace App\Models\Pmda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pmda extends Model
{
    protected $table = 'pip_pmda';
    protected $primaryKey = 'id';
    use HasFactory;


    public function municipio()
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    public function pontos(): BelongsToMany
    {
        return $this->belongsToMany(PmdaPonto::class, 'pip_pmda_pmdaponto', 'pmda_id', 'ponto_id');
    }
}
