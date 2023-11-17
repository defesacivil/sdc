<?php

namespace App\Models\Estoque;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjuDeposito extends Model
{
    protected $table = 'aju_deposito';
    protected $primaryKey = 'id';
    use HasFactory;
}
