<?php

namespace App\Repositories\Admin;

use App\Models\Page;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class PageRepository extends BaseRepository
{

    public function all(): Collection
    {
        $columns = ['id', 'name', 'is_active'];

        return $this->instance()
            ->select($columns)
            ->orderBy('name')
            ->get();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Page::class;
    }
}
