<?php

namespace App\Policies;

use App\Models\Person;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhotoPolicy
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
    public function before($user,$ability)
    {
        if ($user->isAdmin())
        {
            return true;
        }
    }

    public function edit(User $user, Person $person)
    {
        return $user->cedula==$person->PER_CEDULA;
    }
    public function update(User $user, Person $person)
    {
        return $user->cedula==$person->PER_CEDULA;
    }
    public function show(User $user, Person $person)
    {
        return $user->cedula==$person->PER_CEDULA;
    }

}
