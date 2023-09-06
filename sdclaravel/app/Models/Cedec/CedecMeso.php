<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedecMeso extends Model
{
    protected $table = 'cedec_meso';
    protected $primaryKey = 'id';
    use HasFactory;



/**
     * Get the compdec that owns the ComAssociacao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function compdec()
    {
        return $this->hasOne(Compdec::class);
    }


}