<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param string $type
     * @param string $message
     * @return void
     */
    protected static function setAlert(string $type, string $message): void
    {
        request()->session()->flash('type', $type);
        request()->session()->flash('message', $message);
    }
}
