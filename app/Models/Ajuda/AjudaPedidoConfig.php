<?php

namespace App\Models\Ajuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjudaPedidoConfig extends Model
{
    protected $table = 'aju_pedido_anexos';
    protected $primaryKey = 'id';
    use HasFactory;
}
