<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemVersionController extends BaseAdminController
{
    public function __invoke(Request $request): View
    {
        $nodejsVersion = self::getShellCommandOutput(command: 'nodejs -v');
        $npmVersion = self::getShellCommandOutput(command: 'npm -v');

        return view('admin.system_version.index', compact('npmVersion', 'nodejsVersion'));
    }


}
