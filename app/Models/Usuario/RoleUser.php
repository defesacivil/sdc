<?php

namespace App\Models\Usuario;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoleUser extends Model
{
    protected $table = 'model_has_roles';
    protected $primaryKey = 'id';

    protected $fillable = [ 'role_id', 'model_type', 'model_id'];

    use HasFactory;


    /**
     * Get the role associated with the RoleUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roleDem(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }


    
}
