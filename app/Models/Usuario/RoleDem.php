<?php

namespace App\Models\Usuario;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleDem extends Model
{
    protected $fillable = [
        'name',
        'label',

    ];
   
    use HasFactory;

    

     
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }


    public function permissionsDem()
    {
        return $this->belongsToMany(PermissionDem::class, 'permission_role', 'role_id', 'permission_id');
    }

    

   

}
