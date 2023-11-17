<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefeitura extends Model
{
    protected $table = 'cedec_prefeitura';
    protected $primaryKey = 'id';
    use HasFactory;

    protected $fillable = [
        'fotoPref'
    ];

    
}
