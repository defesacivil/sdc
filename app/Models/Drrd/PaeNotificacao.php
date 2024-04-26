<?php

namespace App\Models\Drrd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaeNotificacao extends Model
{
    protected $table = 'pae_notificacaos';
    protected $primaryKey = 'id';
    use HasFactory;


    /**
     * pega as analides que tem nofificações 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function analises()
    {
        return $this->belongsTo(PaeAnalise::class, 'pae_analise_id');
    }

    /**
     * Get user name
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuario()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id')->withDefault();
    }


    public function protocolo(){
        return $this->hasOne(PaeProtocolo::class, 'pae_protocolo_id');
    }

}
