<?php

namespace App\Models\Drrd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaeAnalise extends Model
{
    protected $table = 'pae_analises';
    protected $fillable = ['parecer',
                             'obs', 
                             'tipo',
                              'user_id',
                              'siuacao',
                              'pae_protocolo_id',
                            
                            ];
    protected $primaryKey = 'id';
    
    use HasFactory;


    /**
     * Get the user that owns the PaeAnalise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function protocolos()
    {
        return $this->belongsTo(PaeProtocolo::class, 'pae_protocolo_id');
    }

    /**
     * Get the user that owns the PaeAnalise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notificacoes()
    {
        return $this->hasMany(PaeNotificacao::class, 'pae_analise_id', 'id');
    }

    /**
     * Get the user that owns the PaeAnalise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

}
