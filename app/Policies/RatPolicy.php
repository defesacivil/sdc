<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Compdec\Rat;
use Illuminate\Auth\Access\HandlesAuthorization;

class RatPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /** @test */
    public function delete(User $user)
    {
        //dd('opa');
        return $user->tipo === "cedec";

    }

    
    
}
