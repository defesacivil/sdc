<?php

namespace App\Models\Cedec;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedecUsuario extends Model
{
    protected $table = 'cedec_usuario';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_deposito',    
        'nome',           
        'nivel',          
        'cpf',            
        'login',          
        'id_funcionario', 
        'situacao',       
        'it_m_deposito',  
        'it_m_pipa',      
        'it_m_cce',       
        'it_m_decretacao',
        'it_m_comdec',    
        'it_m_apoio',     
        'it_m_poco',      
        'it_m_escola',    
        'cedec_admin'  
     ];

    
    use HasFactory;

    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
