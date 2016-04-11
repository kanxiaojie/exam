<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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

    public function student(User $user)
    {
        if($user->role_id != 2 )
            return true;
        else
            return false;
    }

    public function teacher(User $user)
    {
        if($user->role_id > 1)
            return true;
        else
            return false;
    }

    public function admin(User $user)
    {
        if($user->role_id == 3)
            return true;
        else
            return false;
    }
}
