<?php

namespace App\Models\Drrd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaeCoord extends Model
{
    protected $table = 'pae_coordenadors';
    protected $primaryKey = 'id';
    
    use HasFactory;
}
