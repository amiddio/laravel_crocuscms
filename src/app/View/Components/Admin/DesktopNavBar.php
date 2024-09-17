<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;

class DesktopNavBar extends BaseComponent
{

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $items = config('admin.main_nav_bar');

        $this->getChildRoutes($items);
        $this->removeNotAllowedItems($items);

        return view('components.admin.desktop-nav-bar', compact('items'));
    }

}
