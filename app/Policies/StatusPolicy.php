<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TaskStatus $status): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can edit models.
     */
    public function edit(User $user, TaskStatus $status): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TaskStatus $status): bool
    {
        return auth()->check();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TaskStatus $status): bool
    {
        return auth()->check();
    }
}
