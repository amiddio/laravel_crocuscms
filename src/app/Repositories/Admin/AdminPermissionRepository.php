<?php

namespace App\Repositories\Admin;

use App\Models\Admin\AdminPermission;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class AdminPermissionRepository extends BaseRepository
{

    public function getAll(): Collection
    {
        $columns = ['id', 'method', 'route'];

        return $this->instance()
            ->select($columns)
            ->orderBy('id', 'asc')
            ->get();
    }

    public function roleSync($role, $permissionIds): void
    {
        try {
            $role->permissions()->sync($permissionIds);
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
            abort(500);
        }
    }

    public function routesSync(): void
    {
        $adminRoutes = $this->getAdminRoutes();

        // Creates row if not exist yet
        foreach ($adminRoutes as $value) {
            [$method, $route] = explode(' ', $value);
            $this->instance()->firstOrCreate([
                'method' => $method,
                'route' => $route
            ]);
        }

        // If route not exist in $adminRoutes we must delete it from db table
        foreach ($this->instance()->all() as $row) {
            $route = $row->method . ' ' . $row->route;
            if (!in_array($route, $adminRoutes)) {
                $row->delete();
            }
        }
    }

    private function getAdminRoutes(): array
    {
        $adminRoutes = [];
        $adminPanelPrefix = config('admin.admin_panel_prefix') . '/';
        $allRoutes = Route::getRoutes()->getRoutes();

        foreach ($allRoutes as $route) {
            if (Str::startsWith($route->uri, $adminPanelPrefix) && !Str::endsWith($route->uri, ['login', 'logout'])) {
                $adminRoutes[] = Str::of($route->methods()[0] . ' ' . Str::replace($adminPanelPrefix, '', $route->uri))->trim()->lower();
            }
        }

        return $adminRoutes;
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return AdminPermission::class;
    }
}
