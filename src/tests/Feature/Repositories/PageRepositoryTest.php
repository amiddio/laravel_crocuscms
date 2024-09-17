<?php

namespace Tests\Feature\Repositories;

use App\Models\Page;
use App\Repositories\PageRepository;
use Database\Factories\PageFactory;
use Database\Factories\PageTranslationFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Arr;
use Tests\TestCase;

class PageRepositoryTest extends TestCase
{

    protected PageRepository $pageRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->pageRepository = new PageRepository();

        PageFactory::new()
            ->count(2)
            ->state(new Sequence(
                ['is_active' => true],
                ['is_active' => false],
            ))
            ->create()
            ->each(function (Page $page) {
                PageTranslationFactory::new()->count(3)->state(new Sequence(
                    ['locale' => 'en', 'page_id' => $page->id],
                    ['locale' => 'ru', 'page_id' => $page->id],
                    ['locale' => 'es', 'page_id' => $page->id],
                ))->create();
            });
    }

    public function testGetPageByNameForIsActive(): void
    {
        $page = Page::where('is_active', true)->first();
        $lang = Arr::random(config('translatable.locales'));

        $result = $this->pageRepository->getPageByName($page->name, $lang);

        $this->assertNotNull($result);
        $this->assertEquals($result->translate($lang)->title, $page->translate($lang)->title);
    }

    public function testGetPageByNameForIsNotActive(): void
    {
        $page = Page::where('is_active', false)->first();
        $lang = Arr::random(config('translatable.locales'));

        $result = $this->pageRepository->getPageByName($page->name, $lang);
        $this->assertNull($result);
    }

    public function testGetPageByNameForNotExistName(): void
    {
        $lang = Arr::random(config('translatable.locales'));

        $result = $this->pageRepository->getPageByName('bla_bla_bla_123', $lang);
        $this->assertNull($result);
    }
}
