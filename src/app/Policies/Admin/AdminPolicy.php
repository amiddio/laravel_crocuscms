<?php

namespace App\Policies\Admin;

use App\Models\Admin\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class AdminPolicy
{
    /**
     * @param Admin $admin
     * @param Admin $instance
     * @return Response
     */
    public function view(Admin $admin, Admin $instance): Response
    {
        return $this->isOwner(
            admin: $admin,
            instance: $instance,
            message: __('You are not allowed to view your admin')
        );
    }

    /**
     * @param Admin $admin
     * @param Admin $instance
     * @return Response
     */
    public function update(Admin $admin, Admin $instance): Response
    {
        return $this->isOwner(
            admin: $admin,
            instance: $instance,
            message: __('You are not allowed to update your admin')
        );
    }

    /**
     * @param Admin $admin
     * @param Admin $instance
     * @return Response
     */
    public function delete(Admin $admin, Admin $instance): Response
    {
        return $this->isOwner(
            admin: $admin,
            instance: $instance,
            message: __('You are not allowed to delete your admin')
        );
    }

    /**
     * @param Admin $admin
     * @param Model $instance
     * @param string $message
     * @return Response
     */
    protected static function isOwner(Admin $admin, Model $instance, string $message): Response
    {
        return $admin->id !== $instance->id ? Response::allow() : Response::deny($message);
    }

}
