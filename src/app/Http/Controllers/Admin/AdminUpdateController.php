<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertColor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAccountUpdateRequest;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUpdateController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $admin = $request->user();

        return view('admin.admin_update.index', compact('admin'));
    }

    /**
     * @param AdminAccountUpdateRequest $request
     * @param AdminRepository $adminRepository
     * @return RedirectResponse
     */
    public function store(AdminAccountUpdateRequest $request, AdminRepository $adminRepository): RedirectResponse
    {
        $validated = $request->validated();

        $admin = $adminRepository->findByCondition(fieldName: 'login', value: $request->user()->login);

        $admin = $adminRepository->update(instance: $admin, data: $validated);
        if ($admin->wasChanged()) {
            self::setAlert(type: AlertColor::SUCCESS, message: __('The admin changed successfully'));
        }

        return redirect()->route('admin.admin_update');
    }

    /**
     * @param Request $request
     * @param AdminRepository $adminRepository
     * @return RedirectResponse
     */
    public function deleteAvatar(Request $request, AdminRepository $adminRepository): RedirectResponse
    {
        $admin = $adminRepository->find(id: $request->user()->id);

        $admin = $adminRepository->update(instance: $admin, data: []);
        if ($admin->wasChanged()) {
            self::setAlert(type: AlertColor::SUCCESS, message: __('Avatar deleted successfully'));
        }

        return redirect()->route('admin.admin_update');
    }

}
