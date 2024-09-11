<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * 
 *
 * @property int $id
 * @property string $method
 * @property string $route
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Admin\AdminRole> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminPermission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminPermission extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'method',
        'route',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'method' => 'string',
        'route' => 'string',
    ];

    /**
     * @return Attribute
     */
    protected function method(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::of($value)->lower(),
        );
    }

    /**
     * @return Attribute
     */
    protected function route(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::of($value)->lower(),
        );
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(AdminRole::class);
    }

}
