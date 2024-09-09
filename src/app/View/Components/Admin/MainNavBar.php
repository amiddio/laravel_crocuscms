<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
        $this->removeNotAllowedItems($items);

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

    private function removeNotAllowedItems(array &$data): void
    {
        if (Auth::guard('admin')->user()->role->name != config('admin.super_admin_role_name')) {
            $allowedRoutes = Auth::guard('admin')->user()->role->permissions()->where('method', 'get')->get(['route'])->pluck('route')->toArray();
            foreach ($data as $key => &$item) {
                if (isset($item['items'])) {
                    foreach ($item['items'] as $keySub => &$itemSub) {
                        if (!in_array($itemSub['uri'], $allowedRoutes)) {
                            unset($item['items'][$keySub]);
                        }
                    }
                }
            }
            foreach ($data as $key => &$item) {
                if ((isset($item['items']) && count($item['items']) == 0) || (isset($item['uri']) && !in_array(
                            $item['uri'],
                            $allowedRoutes
                        ))) {
                    unset($data[$key]);
                }
            }
        }
    }
}
