<?php

namespace App\Models\Ajuda;

use App\Models\Municipio\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cisterna extends Model
{

    protected $table = 'sinc_cisterna';
    protected $primaryKey = 'id';

    //protected $guarded = ['cisterna_id'];
    
    use HasFactory;


     
}
