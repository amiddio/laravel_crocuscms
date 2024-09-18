<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends BaseAdminController
{
    public function __invoke(Request $request): View
    {
        return view('admin.dashboard.index');
    }
}
