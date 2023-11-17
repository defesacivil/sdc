<?php

namespace App\Models\Decreto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cobrade extends Model
{
    protected $table = 'dec_cobrade';
    protected $primaryKey = 'id';
    use HasFactory;
}
