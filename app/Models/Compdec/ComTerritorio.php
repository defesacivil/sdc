<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComTerritorio extends Model
{
    use HasFactory;

    protected $table = 'com_territ_desenv';
    protected $primaryKey = 'id';


    /**
     * Get the compdec that owns the ComTerritorio
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function compdec()
    {
        return $this->belongsTo(Compdec::class, 'territorio_id', 'id');
    }
}
