<?php

namespace Database\Factories;

use App\Models\PageTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageTranslation>
 */
class PageTranslationFactory extends Factory
{

    protected $model = PageTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'intro' => $this->faker->paragraph(),
            'content' => $this->faker->text(),
        ];
    }
}
