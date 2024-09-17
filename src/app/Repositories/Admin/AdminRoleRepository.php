<?php

namespace App\Repositories\Admin;

use App\Models\Admin\AdminRole;
use Illuminate\Support\Collection;

class AdminRoleRepository extends BaseAdminRepository
{

    public function all()
    {
        $columns = ['id', 'name'];

        return $this->instance()
            ->select($columns)
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        $columns = ['id', 'name'];

        return $this->instance()
            ->select($columns)
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name', 'id');
    }

    public function getRelatedPermissionIds(AdminRole $role): array
    {
        return $role->permissions()
            ->select('admin_permission_id')
            ->get()
            ->pluck('admin_permission_id')
            ->toArray();
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return AdminRole::class;
    }
}
