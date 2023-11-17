<?php

namespace App\Models\Compdec;

use App\Models\Decreto\Cobrade;
use App\Models\Municipio\Municipio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rat extends Model
{
    protected $table = 'com_rat';
    protected $primaryKey = 'id';

    use HasFactory;


    /**
     * Get the user associated with the Rat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio(): HasOne
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    /**
     * Get the user associated with the Rat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function operador(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'operador_id');
    }

    /**
     * Get the user associated with the Rat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ocorrencia(): HasOne
    {
        return $this->hasOne(RatOcorrencia::class, 'id', 'ocorrencia_id');
    }

    /**
     * Get the user associated with the Rat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alvo(): HasOne
    {
        return $this->hasOne(RatAlvo::class, 'id', 'alvo_id');
    }

    /**
     * Get the user associated with the Rat
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cobrade(): HasOne
    {
        return $this->hasOne(Cobrade::class, 'id', 'cobrade_id');
    }
}
