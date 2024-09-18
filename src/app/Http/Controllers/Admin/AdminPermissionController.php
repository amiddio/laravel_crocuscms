<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Admin\AdminPermissionRepository;
use App\Repositories\Admin\AdminRoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPermissionController extends BaseAdminController
{

    public function __construct(
        protected AdminRoleRepository $adminRoleRepository,
        protected AdminPermissionRepository $adminPermissionRepository
    ) {
    }

    public function index(Request $request): View
    {
        $roles = $this->adminRoleRepository->list();
        $roleId = $request->get('role_id', null);

        if ($roleId) {
            $role = $this->getRole(roleId: $roleId);
            $this->adminPermissionRepository->routesSync();
            $allAdminRoutes = $this->adminPermissionRepository->getAll();
            $relatedPermissions = $this->adminRoleRepository->getRelatedPermissionIds(role: $role);
        } else {
            $allAdminRoutes = $relatedPermissions = [];
        }

        return view(
            'admin.admin_permission.index',
            compact('roles', 'roleId', 'allAdminRoutes', 'relatedPermissions')
        );
    }

    private function getRole(int $roleId): \Illuminate\Database\Eloquent\Model
    {
        $role = $this->adminRoleRepository->find($roleId);
        if (!$role) {
            abort(404);
        }
        if ($role->name == config('admin.super_admin_role_name')) {
            abort(403);
        }

        return $role;
    }

    public function update(Request $request, int $roleId): RedirectResponse
    {
        $role = $this->getRole(roleId: $roleId);
        $this->adminPermissionRepository->roleSync(role: $role, permissionIds: $request->get('routes'));

        return redirect()->route('admin.admin_permissions', ['role_id' => $roleId]);
    }
}
