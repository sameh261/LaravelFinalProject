<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function admin(User $user)
    {
        return $user->role_id === 1;
    }

    public function moderator(User $user)
    {
        return $user->role_id === 2;
    }

    public function user(User $user)
    {
        return $user->role_id === 3;
    }
}
