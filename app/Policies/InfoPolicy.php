<?php

namespace App\Policies;

use App\Info;
use App\LocalAuth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class InfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the info.
     *
     * @param  \  $user
     * @param  \App\Info  $info
     * @return mixed
     */
    public function view( $user, Info $info)
    {
        //
        $user = Auth::user()->user;
        return $user->id === $info->user_id;
    }

    /**
     * Determine whether the user can create infos.
     *
     * @param  \  $user
     * @return mixed
     */
    public function create( $user)
    {
        //
    }

    /**
     * Determine whether the user can update the info.
     *
     * @param  \  $user
     * @param  \App\Info  $info
     * @return mixed
     */
    public function update( $user, Info $info)
    {
        //
        $user = Auth::user()->user;
        return $user->id === $info->user_id;
    }

    /**
     * Determine whether the user can delete the info.
     *
     * @param  \  $user
     * @param  \App\Info  $info
     * @return mixed
     */
    public function delete( $user, Info $info)
    {
        //
        $user = Auth::user()->user;
        return $user->id === $info->user_id;
    }
}
