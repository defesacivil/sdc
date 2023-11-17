<?php

namespace App\Models\Estoque;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjudaEstoqFornecedor extends Model
{
    protected $table = 'aju_fornecedores';
    protected $primaryKey = 'id';
    use HasFactory;
}
