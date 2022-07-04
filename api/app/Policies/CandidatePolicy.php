<?php

namespace App\Policies;

use App\Enums\Permission;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can(Permission::MANAGE_CANDIDATE);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Candidate $candidate)
    {
        return $user->can(Permission::MANAGE_CANDIDATE);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can(Permission::MANAGE_CANDIDATE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Candidate $candidate)
    {
        return $user->can(Permission::MANAGE_CANDIDATE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Candidate $candidate)
    {
        return $user->can(Permission::MANAGE_CANDIDATE);
    }
}
