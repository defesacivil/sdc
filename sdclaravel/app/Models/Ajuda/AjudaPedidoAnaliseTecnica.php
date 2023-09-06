<?php

namespace App\Models\Ajuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjudaPedidoAnaliseTecnica extends Model
{
    protected $table = 'aju_pedido_antecs';
    protected $primaryKey = 'id';

    use HasFactory;
}
