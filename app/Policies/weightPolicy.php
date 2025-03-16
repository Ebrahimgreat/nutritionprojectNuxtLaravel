<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Weight;


class weightPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, Weight $weight)
    {
        return $user->id === $weight->user_id;

    }
}
