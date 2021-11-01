<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param ?User $user
     * @return Response|bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  Task $task
     * @return Response|bool
     */
    public function view(User $user, Task $task)
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
     * @param Task $task
     * @return Response|bool
     */
    public function update(User $user, Task $task)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Task $task
     * @return Response|bool
     */
    public function delete(User $user, Task $task)
    {
        return (int) $user->id === (int) $task->created_by_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  Task $task
     * @return Response|bool
     */
    public function restore(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  Task $task
     * @return Response|bool
     */
    public function forceDelete(User $user, Task $task)
    {
        return $user->id === $task->created_by_id;
    }
}
