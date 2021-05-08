<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserUsers;
use Illuminate\Auth\Access\HandlesAuthorization;

class SharePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user) {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserUsers  $userUsers
     * @return mixed
     */
    public function view(User $user, UserUsers $userUsers) {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user) {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserUsers  $userUsers
     * @return mixed
     */
    public function update(User $user, UserUsers $userUsers) {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserUsers  $userUsers
     * @return mixed
     */
    public function delete(User $user, UserUsers $share) {
		if ((int)$share->owner_id === (int)$user->id) {
			return true;
		} else {
			return false;
		}
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserUsers  $userUsers
     * @return mixed
     */
    public function restore(User $user, UserUsers $userUsers) {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\UserUsers  $userUsers
     * @return mixed
     */
    public function forceDelete(User $user, UserUsers $userUsers) {
        //
    }
}
