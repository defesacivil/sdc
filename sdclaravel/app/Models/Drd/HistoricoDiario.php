<?php

namespace App\Models\Drd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoDiario extends Model
{
    protected $table = 'cce_historicod';
    // protected $fillable = ['situacao',                           
    //                         ];
    protected $primaryKey = 'id';
    use HasFactory;
}
