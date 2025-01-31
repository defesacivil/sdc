<?php

namespace App\Models\Decreto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decreto extends Model
{
    use HasFactory;

    protected $table = 'dec_processo';
    protected $primaryKey = 'id';
}
