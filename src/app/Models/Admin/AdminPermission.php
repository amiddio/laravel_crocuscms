<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

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
