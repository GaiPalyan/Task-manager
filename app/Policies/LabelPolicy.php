<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

/**
 * Suppress all rules containing "unused" in this
 * class
 *
 * @SuppressWarnings("unused")
 */
class LabelPolicy
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
     * @param ?User $user
     * @param Label $label
     * @return bool
     */
    public function view(?User $user, Label $label): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Label $label
     * @return Response|bool
     */
    public function update(User $user, Label $label)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Label $label
     * @return Response|bool
     */
    public function delete(User $user, Label $label)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Label $label
     * @return Response|bool
     */
    /*public function restore(User $user, Label $label)
    {
        //
    }*/

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Label $label
     * @return Response|bool
     */
    /*public function forceDelete(User $user, Label $label)
    {
        //
    }*/
}
