<?php

namespace App\Policies;

use App\Models\Totourial;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TotourialPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Totourial  $totourial
     * @return mixed
     */
    public function view(User $user, Totourial $totourial)
    {
        return $user->is($totourial->user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Totourial  $totourial
     * @return mixed
     */
    public function update(User $user, Totourial $totourial)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Totourial  $totourial
     * @return mixed
     */
    public function delete(User $user, Totourial $totourial)
    {
        return $user->id == $totourial->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Totourial  $totourial
     * @return mixed
     */
    public function restore(User $user, Totourial $totourial)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Totourial  $totourial
     * @return mixed
     */
    public function forceDelete(User $user, Totourial $totourial)
    {
        //
    }
}
