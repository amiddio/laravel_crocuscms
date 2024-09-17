<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string|null $intro
 * @property string|null $content
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @property-read \App\Models\PageTranslation|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PageTranslation> $translations
 * @property-read int|null $translations_count
 * @method static Builder|Page active()
 * @method static \Database\Factories\PageFactory factory($count = null, $state = [])
 * @method static Builder|Page listsTranslations(string $translationField)
 * @method static Builder|Page notTranslatedIn(?string $locale = null)
 * @method static Builder|Page orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static Builder|Page orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static Builder|Page orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static Builder|Page translated()
 * @method static Builder|Page translatedIn(?string $locale = null)
 * @method static Builder|Page whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static Builder|Page whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static Builder|Page withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Page extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    /**
     * @var array<int, string>
     */
    public array $translatedAttributes = ['title', 'intro', 'content'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'intro',
        'content',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
        'title' => 'string',
        'intro' => 'string',
        'content' => 'string',
        'is_active' => 'boolean',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

}
