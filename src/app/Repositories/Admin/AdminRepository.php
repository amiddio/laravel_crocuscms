<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Admin;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CreateInterface;
use App\Repositories\Interfaces\UpdateInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminRepository extends BaseRepository implements CreateInterface, UpdateInterface
{

    public function create(array $data): ?Model
    {
        Arr::set($data, 'password', Hash::make($data['password']));

        try {
            return $this->instance()->create($data);
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
        }
        return null;
    }

    public function findByCondition(string $fieldName, string $value, string $operator = '='): ?Model
    {
        return $this->instance()
            ->where($fieldName, $operator, $value)
            ->first();
    }

    public function update(Model $instance, array $data): ?Model
    {
        try {
            return tap($instance, function ($model) use ($data) {
                $model->fill($data);
                $model->save();
            });
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
        }
        return null;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Admin::class;
    }
}
