<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
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
    public function destroy(User $user, Status $status)
    {
        return $user->id === $status->user_id;
        // 验证当前登录用户id等于微博发布者的id才可以删除
    }
}