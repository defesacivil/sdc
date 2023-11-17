<?php

namespace App\Models\Pmda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PmdaPmdaPonto extends Model
{
    protected $table = 'pip_pmda_pmdaponto';
    protected $primaryKey = 'id';
    use HasFactory;


    /* ponto relacionado com */
    public function ponto(): HasOne
    {
        return $this->hasOne(PmdaPonto::class, 'id', 'ponto_id');
    }
    
}
