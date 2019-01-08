<?php

namespace App\Policies;

use App\User;
use App\BshCase;
use Illuminate\Auth\Access\HandlesAuthorization;

class BshCasePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view the bshCase.
     *
     * @param  \App\User  $user
     * @param  \App\BshCase  $bshCase
     * @return mixed
     */
    public function view(User $user, BshCase $bshCase)
    {
        return $user->id === $bshCase->user_id;
    }

    /**
     * Determine whether the user can create bshCases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the bshCase.
     *
     * @param  \App\User  $user
     * @param  \App\BshCase  $bshCase
     * @return mixed
     */
    public function update(User $user, BshCase $bshCase)
    {
        return $user->id === $bshCase->user_id;
    }

    /**
     * Determine whether the user can delete the bshCase.
     *
     * @param  \App\User  $user
     * @param  \App\BshCase  $bshCase
     * @return mixed
     */
    public function delete(User $user, BshCase $bshCase)
    {
        return false;
    }
}
