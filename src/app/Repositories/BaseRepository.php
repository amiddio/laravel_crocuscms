<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository
{

    /**
     * @var Model
     */
    private Model $model;

    public function __construct()
    {
        $this->model = new ($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;

    /**
     * @return Model
     */
    protected function instance(): Model
    {
        return $this->model;
    }

    /**
     * @param array $data
     * @return Model|null
     */
    public function create(array $data): ?Model
    {
        try {
            return $this->instance()->create($data);
        } catch (QueryException  $exception) {
            Log::error($exception->getMessage());
        }
        return null;
    }

    /**
     * @param Model $instance
     * @return bool|null
     */
    public function delete(Model $instance): ?bool
    {
        try {
            return $instance->delete();
        } catch (QueryException $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * @param Model $instance
     * @param array $data
     * @return Model|null
     */
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
     * @param string $fieldName
     * @param string $value
     * @param string $operator
     * @return Model|null
     */
    public function findByCondition(string $fieldName, string $value, string $operator = '='): ?Model
    {
        return $this->instance()
            ->where($fieldName, $operator, $value)
            ->first();
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->instance()
            ->find($id);
    }

}
