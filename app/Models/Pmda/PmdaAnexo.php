<?php

namespace App\Models\Pmda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PmdaAnexo extends Model
{

    protected $table = 'pip_pmda_anexo';
    protected $primaryKey = 'id';
    use HasFactory;
}
