<?php

namespace Tests\Feature;

use App\Models\Page;
use Database\Factories\PageFactory;
use Database\Factories\PageTranslationFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class PageTest extends TestCase
{

    public function testPageAboutUsIsActive(): void
    {
        PageFactory::new()
            ->create([
                'name' => 'about_us',
                'is_active' => true,
            ])
            ->each(function (Page $page) {
                PageTranslationFactory::new()->count(3)->state(
                    new Sequence(
                        ['locale' => 'en', 'page_id' => $page->id],
                        ['locale' => 'ru', 'page_id' => $page->id],
                        ['locale' => 'es', 'page_id' => $page->id],
                    )
                )->create();
            });

        $this->get('/about_us')->assertStatus(200);
        $this->get('/ru/about_us')->assertStatus(200);
        $this->get('/es/about_us')->assertStatus(200);
    }

    public function testPageAboutUsNotIsActive(): void
    {
        PageFactory::new()
            ->create([
                'name' => 'about_us',
                'is_active' => false,
            ])
            ->each(function (Page $page) {
                PageTranslationFactory::new()->count(3)->state(
                    new Sequence(
                        ['locale' => 'en', 'page_id' => $page->id],
                        ['locale' => 'ru', 'page_id' => $page->id],
                        ['locale' => 'es', 'page_id' => $page->id],
                    )
                )->create();
            });

        $this->get('/about_us')->assertStatus(404);
        $this->get('/ru/about_us')->assertStatus(404);
        $this->get('/es/about_us')->assertStatus(404);
    }
}
