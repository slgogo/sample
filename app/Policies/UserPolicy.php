<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $currentUser, User $user)
    // 第一个参数为当前登录用户实例,第二个为进行授权用户实例
    {
        return $currentUser->id === $user->id;
        // 当两个id相同，用户通过授权，否则显示403
    }
}
