<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'ACTIVE';
    public const STATUS_INACTIVE = 'INACTIVE';

    protected $fillable = [
        'plan_name',
        'price',
        'description',
        'status',
        'counsellor',
        'language',
        'report',
        'ai_drive_career_support',
        'career_counselling_session',
        'sessions_with_role_model_and_parents',
        'certified_expert_guidence',
    ];

    public static function getStatusList(): array
    {
        return [
            self::STATUS_ACTIVE => __('Active'),
            self::STATUS_INACTIVE => __('Inactive'),
        ];
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeIsInactive($query)
    {
        return $query->where('status', self::STATUS_INACTIVE);
    }

    /**
     * Get the tests associated with this package through the pivot table.
     */
    public function tests(): BelongsToMany
    {
        return $this->belongsToMany(Test::class, 'package_has_tests')
                    ->withTimestamps();
    }

    /**
     * Get the package-test relationships for this package.
     */
    public function packageHasTests(): HasMany
    {
        return $this->hasMany(PackageHasTest::class);
    }

    /**
     * Get only activated tests for this package.
     */
    public function activeTests(): BelongsToMany
    {
        return $this->tests()->where('activated', true);
    }

    /**
     * Get the total number of tests associated with this package.
     */
    public function getTestsCountAttribute(): int
    {
        return $this->tests()->count();
    }

    /**
     * Get the total number of active tests associated with this package.
     */
    public function getActiveTestsCountAttribute(): int
    {
        return $this->activeTests()->count();
    }
}
