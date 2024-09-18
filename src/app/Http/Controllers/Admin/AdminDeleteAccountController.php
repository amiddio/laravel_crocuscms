<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertColor;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminDeleteAccountController extends BaseAdminController
{
    public function index(): View
    {
        return view('admin.delete_account.index');
    }

    public function destroy(Request $request, AdminRepository $adminRepository): RedirectResponse
    {
        $admin = $adminRepository->find(id: $request->user()->id);

        if ($admin !== null && $adminRepository->delete($admin)) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login');
        }

        self::setAlert(
            type: AlertColor::ERROR,
            message: __(
            'An error has occurred deleting your account. Please contact the administrator.'
        )
        );

        return redirect()->route('admin,delete_account.index');
    }

}
