<?php

namespace App\Policies;

use App\Models\Mark;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function storeMore(User $user) {
        return $user->permission == 'admin';
    }
}
