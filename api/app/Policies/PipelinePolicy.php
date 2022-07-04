<?php

namespace App\Policies;

use App\Enums\Permission;
use App\Models\Pipeline;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PipelinePolicy
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
        return $user->hasAnyPermission([Permission::MANAGE_PIPELINE, Permission::VIEW_PIPELINE]);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Pipeline $pipeline)
    {
        return $user->hasAnyPermission([Permission::MANAGE_PIPELINE, Permission::VIEW_PIPELINE]);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can(Permission::MANAGE_PIPELINE);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Pipeline $pipeline)
    {
        return $user->can(Permission::MANAGE_PIPELINE);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pipeline  $pipeline
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Pipeline $pipeline)
    {
        return $user->can(Permission::MANAGE_PIPELINE);
    }
}
