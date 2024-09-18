<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertColor;
use App\Http\Requests\Admin\AdminRoleCreateRequest;
use App\Http\Requests\Admin\AdminRoleUpdateRequest;
use App\Repositories\Admin\AdminRoleRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminRoleController extends BaseAdminController
{

    public function __construct(
        protected AdminRoleRepository $adminRoleRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = $this->adminRoleRepository->all();

        return view('admin.admin_role.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRoleCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($role = $this->adminRoleRepository->create($validated)) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'Role \':role\' created successfully',
                    ['role' => $role->name]
                )
            );
        } else {
            self::setAlert(
                type: AlertColor::ERROR,
                message: __(
                    'An error has occurred creating role. Please contact the administrator.'
                )
            );
        }

        return redirect()->route('admin.admin_roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.admin_role.create');
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(string $id)
    {
        $role = $this->adminRoleRepository->find(id: $id);
        if (!$role) {
            abort(404);
        }

        Gate::authorize('view', $role);

        return view('admin.admin_role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(AdminRoleUpdateRequest $request, string $id): RedirectResponse
    {
        $role = $this->adminRoleRepository->find(id: $id);
        if (!$role) {
            abort(404);
        }

        Gate::authorize('update', $role);

        $validated = $request->validated();

        $role = $this->adminRoleRepository->update($role, $validated);
        if ($role->wasChanged()) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'The role \':role\' changed successfully',
                    ['role' => $role->name]
                )
            );
        }

        return redirect()->route('admin.admin_roles.index');
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $id)
    {
        $role = $this->adminRoleRepository->find(id: $id);
        if (!$role) {
            abort(404);
        }

        Gate::authorize('delete', $role);

        if ($this->adminRoleRepository->delete($role)) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'The role \':role\' deleted successfully',
                    ['role' => $role->name]
                )
            );
        } else {
            self::setAlert(
                type: AlertColor::ERROR,
                message: __(
                    'An error has occurred deleting role. Please contact the administrator.'
                )
            );
        }

        return redirect()->route('admin.admin_roles.index');
    }
}
