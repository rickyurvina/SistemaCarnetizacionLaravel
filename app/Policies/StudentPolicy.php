<?php

namespace App\Policies;

use App\Models\Student;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
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

    public function edit(User $user, Student $student)
    {
       return $user->cedula==$student->EST_CEDULA;
    }
    public function update(User $user, Student $student)
    {
        return $user->cedula==$student->EST_CEDULA;
    }
    public function show(User $user, Student $student)
    {
        return $user->cedula==$student->EST_CEDULA;
    }
}
