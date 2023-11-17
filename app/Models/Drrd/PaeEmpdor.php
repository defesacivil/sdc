<?php

namespace App\Models\Drrd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaeEmpdor extends Model
{
    protected $table = 'pae_empdors';
    protected $primaryKey = 'id';
    use HasFactory;


    public function empreendimento(){

        return $this->hasMany(PaeEmpnto::class, 'id');
    }
}
