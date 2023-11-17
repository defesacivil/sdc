<?php

namespace App\Models\Drd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    protected $table = 'cce_diario';
    //protected $fillable = ['situacao',                           
                            //];
    protected $primaryKey = 'id';
    use HasFactory;
}
