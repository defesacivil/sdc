<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComAssociacao extends Model
{
    use HasFactory;

    protected $table = 'com_associacao';

    /**
     * Get the compdec that owns the ComAssociacao
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function compdec()
    {
        return $this->belongsTo(Compdec::class, 'associacao_id', 'id');
    }

    
}
