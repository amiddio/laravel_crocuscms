<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertColor;
use App\Http\Requests\Admin\AdminCreateRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\AdminRoleRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AdminController extends BaseAdminController
{

    /**
     * @param AdminRepository $adminRepository
     */
    public function __construct(
        protected AdminRepository $adminRepository,
        protected AdminRoleRepository $adminRoleRepository
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $admins = $this->adminRepository->paginate(excludeCurrentLogin: $request->user('admin')->login);

        return view('admin.admin.index', compact('admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCreateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($admin = $this->adminRepository->create($validated)) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'Admin \':admin\' created successfully',
                    ['admin' => $admin->login]
                )
            );
        } else {
            self::setAlert(
                type: AlertColor::ERROR,
                message: __(
                    'An error has occurred creating admin. Please contact the administrator.'
                )
            );
        }

        return redirect()->route('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = $this->adminRoleRepository->list();

        return view('admin.admin.create', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(string $id)
    {
        $admin = $this->adminRepository->find(id: $id);
        if (!$admin) {
            abort(404);
        }

        Gate::authorize('view', $admin);

        $roles = $this->adminRoleRepository->list();

        return view('admin.admin.edit', compact('admin', 'roles'));
    }

    /**
     * @param string $id
     * @return View
     * @throws AuthorizationException
     */
    public function show(string $id): View
    {
        $admin = $this->adminRepository->find(id: $id);
        if (!$admin) {
            abort(404);
        }

        Gate::authorize('view', $admin);

        return view('admin.admin.show', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException
     */
    public function update(AdminUpdateRequest $request, string $id): RedirectResponse
    {
        $admin = $this->adminRepository->find(id: $id);
        if (!$admin) {
            abort(404);
        }

        Gate::authorize('update', $admin);

        $validated = $request->validated();

        $admin = $this->adminRepository->update($admin, $validated);
        if ($admin->wasChanged()) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'The admin \':login\' changed successfully',
                    ['login' => $admin->login]
                )
            );
        }

        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $id): RedirectResponse
    {
        $admin = $this->adminRepository->find(id: $id);
        if (!$admin) {
            abort(404);
        }

        Gate::authorize('delete', $admin);

        if ($this->adminRepository->delete($admin)) {
            self::setAlert(
                type: AlertColor::SUCCESS,
                message: __(
                    'The admin \':login\' deleted successfully',
                    ['login' => $admin->login]
                )
            );
        } else {
            self::setAlert(
                type: AlertColor::ERROR,
                message: __(
                    'An error has occurred deleting admin. Please contact the administrator.'
                )
            );
        }

        return redirect()->route('admin.admins.index');
    }
}
