<?php

namespace App\Models\Ajuda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cisterna extends Model
{

    protected $table = 'aju_cisterna_cadastro';
    protected $primaryKey = 'cisterna_id';

    protected $guarded = ['cisterna_id'];
    
    use HasFactory;
}
