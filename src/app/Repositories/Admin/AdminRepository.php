<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Admin;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRepository extends BaseRepository
{

    private const PER_PAGE = 10;

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        Arr::set($data, 'password', Hash::make($data['password']));

        return parent::create($data);
    }

    /**
     * @param Model $instance
     * @param array $data
     * @return Model|null
     */
    public function update(Model $instance, array $data): ?Model
    {
        if (Arr::has($data, 'password')) {
            if (Arr::get($data, 'password', null) !== null) {
                Arr::set($data, 'password', Hash::make($data['password']));
            } else {
                Arr::forget($data, 'password');
            }
        }

        return parent::update($instance, $data);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        $columns = ['id', 'name', 'login', 'is_active'];

        return $this->instance()
            ->select($columns)
            ->where('login', '!=', Auth::guard('admin')->user()->login)
            ->latest()
            ->paginate(self::PER_PAGE);
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Admin::class;
    }
}
