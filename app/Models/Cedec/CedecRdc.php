<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedecRdc extends Model
{
    protected $table = 'cedec_rpm_mun';
    protected $primaryKey = 'id';
    use HasFactory;

}
