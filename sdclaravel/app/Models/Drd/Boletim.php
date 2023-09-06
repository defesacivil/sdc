<?php

namespace App\Models\Drd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Boletim extends Model
{
    protected $table = 'cce_boletim';
    protected $fillable = ['situacao',                           
                            ];
    protected $primaryKey = 'id';
    use HasFactory;


    /**
     * Get the user associated with the Boletim
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario(): HasOne
    {
        return $this->hasOne(User::class, 'usuario_id', 'id');
    }
}
