<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

/**
 * Suppress all rules containing "unused" in this
 * class
 *
 * @SuppressWarnings("unused")
 */
class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param ?User $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param TaskStatus $status
     * @return bool
     */
    public function view(User $user, TaskStatus $status): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * @param User $user
     * @param TaskStatus $status
     * @return bool
     */
    public function edit(User $user, TaskStatus $status): bool
    {
        return true;
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param TaskStatus $status
     * @return bool
     */
    public function update(User $user, TaskStatus $status): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param TaskStatus $status
     * @return bool
     */
    public function delete(User $user, TaskStatus $status): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param TaskStatus $status
     * @return bool
     */
    /*public function restore(User $user, TaskStatus $status): bool
    {
        //
    }*/

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param TaskStatus $status
     * @return Response|bool
     */
    /*public function forceDelete(User $user, TaskStatus $status)
    {
        //
    }*/
}
