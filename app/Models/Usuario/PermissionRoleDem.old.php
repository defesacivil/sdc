<?php

namespace App\Models\Usuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PermissionRoleDem extends Model
{
    protected $table = 'permission_role';
    protected $primaryKey = 'id';

    protected $fillable = ['permission_id', 'role_id'];

    
    use HasFactory;


    /**
     * Get the role associated with the RoleUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function permissionDem(): HasOne
    {
        return $this->hasOne(PermissionDem::class, 'id', 'permission_id');
    }


        
}
