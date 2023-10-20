<?php

namespace App\Models\Ajuda;

use App\Models\Cedec\CedecMeso;
use App\Models\Decreto\Cobrade;
use App\Models\Municipio\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AjudaPedido extends Model
{
    protected $table = 'aju_pedido_pedidos';
    protected $primaryKey = 'id';

    use HasFactory;



    /**
     * Get the user associated with the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio(): HasOne
    {
        return $this->hasOne(Municipio::class, 'id', 'municipio_id');
    }

    /**
     * Get the user associated with the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cobrade(): HasOne
    {
        return $this->hasOne(Cobrade::class, 'id', 'cobrade_id');
    }

    /**
     * Get the user associated with the Pedido
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     *  meso regiao
     */
    public function mesoregiao(): HasOne
    {
        return $this->hasOne(CedecMeso::class, 'id', 'regiao_id');
    }


   
}
