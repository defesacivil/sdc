<?php

namespace App\Models;

use App\Models\Cedec\CedecUsuario;
use App\Models\Drrd\PaeAnalise;
use App\Models\Usuario\RoleDem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'id_user_cedec',
        'cpf',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cedecusuario()
    {
        return $this->hasOne(CedecUsuario::class);
    }

    //public function hasRole(){

        //return $user->tipo == 

    //}
   
    public function rolesDem()
    {
        return $this->belongsToMany(RoleDem::class, 'role_users', 'user_id', 'role_id');
    }


    public function analise(){

        return $this->belongsTo(PaeAnalise::class, 'user_id');
    }

    


    
    
   
}
