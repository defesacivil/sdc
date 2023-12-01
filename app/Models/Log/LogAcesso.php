<?php

namespace App\Models\Log;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAcesso extends Model
{
    #protected $table = 'logs_ac_'.$date('Y');
    protected $table = 'logs';
    protected $primaryKey = 'id';
    use HasFactory;
}
