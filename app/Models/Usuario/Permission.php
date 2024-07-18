<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'label',

    ];
    use HasFactory;



    
    public function rolesDem()
    {
        return $this->belongsToMany(RoleDem::class, 'permission_role', 'permission_id', 'role_id');
    }


}
