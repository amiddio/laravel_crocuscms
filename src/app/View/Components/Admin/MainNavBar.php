<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class MainNavBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $items = config('admin.main_nav_bar');

        $this->getChildRoutes($items);

        //dd($items);

        return view('components.admin.main-nav-bar', compact('items'));
    }

    private function getChildRoutes(array &$data): void
    {
        foreach ($data as &$item) {
            if (isset($item['items'])) {
                $routes = data_get($item, 'items.*.route');
                Arr::set($item, 'child_routes', $routes);
            }
        }
    }
}
