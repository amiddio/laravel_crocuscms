<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertColor;
use App\Http\Requests\Admin\ChangePasswordRequest;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminChangePasswordController extends BaseAdminController
{

    /**
     * @return View
     */
    public function index(Request $request): View
    {
        return view('admin.change_password.index');
    }

    /**
     * @param ChangePasswordRequest $request
     * @param AdminRepository $adminRepository
     * @return RedirectResponse
     * @throws AuthenticationException
     */
    public function store(ChangePasswordRequest $request, AdminRepository $adminRepository): RedirectResponse
    {
        if (!Hash::check($request->get('current_password'), $request->user()->password)) {
            return back()->withErrors([
                'current_password' => [__('The provided password does not match our records.')]
            ]);
        }

        $data = ['password' => Hash::make($request->get('password'))];

        $admin = $adminRepository->find(id: $request->user()->id);

        if ($admin !== null && $adminRepository->update(instance: $admin, data: $data)) {
            Auth::guard('admin')->logoutOtherDevices($request->get('current_password'));
            self::setAlert(type: AlertColor::SUCCESS, message: __('The password changed successfully'));
        } else {
            self::setAlert(type: AlertColor::ERROR, message: __('The password could not changed'));
        }

        return redirect()->route('admin.change_password');
    }

}
