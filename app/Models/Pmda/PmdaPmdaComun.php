<?php

namespace App\Models\Pmda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PmdaPmdaComun extends Model
{

    protected $table = 'pip_pmda_comun';
    protected $primaryKey = 'id';
    use HasFactory;


/**
 * Get the user associated with the PmdaComun
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function comunidade(): HasOne
{
    return $this->hasOne(PmdaComunidade::class, 'id', 'comunidade_id');
}
}
