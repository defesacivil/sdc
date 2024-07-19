<?php

namespace App\Models\Drrd;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaeProtocolo extends Model
{

    protected $table = 'pae_protocolos';
    protected $fillable = [ 'dt_entrada',
                            'user_id',
                            'limite_analise',
                            'ccpae',
                            'ccpae_venc',
                            'empnto_search',
                            'pae_empnto_id',
                            'obs',
                            'situacao'];
    protected $primaryKey = 'id';
    
    use HasFactory;


    /**
         * Get all of the analises for the PaeProtocolo
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function analises()
        {
            return $this->hasMany(PaeAnalise::class, 'pae_protocolo_id', 'id');
        }

    /**
     * Get all of the comments for the PaeProtocolo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empreendimento()
    {
        return $this->hasOne(PaeEmpnto::class,  'id', 'pae_empnto_id');
    }

    /**
     * Get user name
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'user_id');
    }

    /**
     * Get tramitações
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tramitacoes()
    {
        //return $this->hasMany(tramNotificacao::class, 'protocolo_id','id' );
    }

    
    public function getNotificacao($id_protocolo){
        
        $notificacao = PaeProtocolo::with('analise',
                                          'analise.protocolos')
                                          ->whereRaw("'pae_protocolos.id' = ".$id_protocolo)
                                          ->whereRaw("DATEDIFF('pae_notIficacaos.dt_devolutiva', '".Carbon::now()."') <=5")
                                          ->get();
    }
  


}
