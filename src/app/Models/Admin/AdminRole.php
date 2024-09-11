<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Admin\AdminPermission> $permissions
 * @property-read int|null $permissions_count
 * @method static \Database\Factories\Admin\AdminRoleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminRole whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminRole extends Model
{
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::of($value)->lower()->ucfirst(),
        );
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(AdminPermission::class);
    }

}
