<?php

namespace App\Models\Ajuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjudaPedidoItens extends Model
{

    protected $table = "aju_pedido_itens";
    protected $primaryKey = "id";
    
    use HasFactory;
}
