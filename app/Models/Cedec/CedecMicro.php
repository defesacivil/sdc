<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedecMicro extends Model
{
    protected $table = 'cedec_micro';
    protected $primaryKey = 'id';
    use HasFactory;
}
