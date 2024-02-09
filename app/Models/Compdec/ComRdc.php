<?php

namespace App\Models\Compdec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComRdc extends Model
{
    
    protected $table = 'cedec_rpm';
    protected $primaryKey = 'id';
    
    use HasFactory;
    
}
