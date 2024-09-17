<?php

namespace App\View\Components\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

abstract class BaseComponent extends Component
{

    /**
     * @param array $data
     * @return void
     */
    protected function getChildRoutes(array &$data): void
    {
        foreach ($data as &$item) {
            $item['is_active'] = false;
            if (isset($item['items'])) {
                $routes = data_get($item, 'items.*.route');
                Arr::set($item, 'child_routes', $routes);
                foreach ($item['items'] as &$subItem) {
                    $subItem['is_active'] = request()->is(
                        config('admin.admin_panel_prefix') . '/' . $subItem['uri'] . '*'
                    );
                    if ($subItem['is_active']) {
                        $item['is_active'] = true;
                    }
                }
            } else {
                $item['is_active'] = request()->is(config('admin.admin_panel_prefix') . '/' . $item['uri'] . '*');
            }
        }
    }

    /**
     * @param array $data
     * @return void
     */
    protected function removeNotAllowedItems(array &$data): void
    {
        if (Auth::guard('admin')->user()->role->name != config('admin.super_admin_role_name')) {
            $allowedRoutes = Auth::guard('admin')->user()->role->permissions()->where('method', 'get')->get(['route']
            )->pluck('route')->toArray();
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
