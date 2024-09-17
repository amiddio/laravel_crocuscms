<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Page::class;
    }

    /**
     * @param $pageName
     * @param $lang
     * @return null
     */
    public function getPageByName($pageName, $lang)
    {
        $columns = ['id', 'name'];

        $page = $this->instance()
            ->where('name', $pageName)
            ->active()
            ->first($columns);

        if (!$page || !$page->hasTranslation($lang)) {
            return null;
        }

        return $page;
    }
}
