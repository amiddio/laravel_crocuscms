<?php

namespace App\Policies\Admin;

use App\Models\Admin\Admin;
use App\Models\Admin\AdminRole;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

class AdminRolePolicy
{

    private string $administrator;

    public function __construct()
    {
        $this->administrator = config('admin.super_admin_role_name');
    }

    /**
     * @param Admin $admin
     * @param AdminRole $instance
     * @return Response
     */
    public function view(Admin $admin, AdminRole $instance): Response
    {
        return $this->isNotAdministrator(
            instance: $instance, message: __('You are not allowed to view :admin role', ['admin' => $this->administrator])
        );
    }

    /**
     * @param Admin $admin
     * @param AdminRole $instance
     * @return Response
     */
    public function update(Admin $admin, AdminRole $instance): Response
    {
        return $this->isNotAdministrator(
            instance: $instance, message: __('You are not allowed to update :admin role', ['admin' => $this->administrator])
        );
    }

    /**
     * @param Admin $admin
     * @param AdminRole $instance
     * @return Response
     */
    public function delete(Admin $admin, AdminRole $instance): Response
    {
        return $this->isNotAdministrator(
            instance: $instance, message: __('You are not allowed to delete :admin role', ['admin' => $this->administrator])
        );
    }

    private function isNotAdministrator(Model $instance, string $message): Response
    {
        return $this->administrator != $instance->name ? Response::allow() : Response::deny($message);
    }
}
