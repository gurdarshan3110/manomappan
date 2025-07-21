<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Test extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'display_name',
        'language',
        'price_counselor',
        'price_counselee',
        'counter_counselor',
        'counter_counselee',
        'activated',
        'external_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price_counselor' => 'integer',
        'price_counselee' => 'integer',
        'counter_counselor' => 'integer',
        'counter_counselee' => 'integer',
        'activated' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Scope to filter only activated tests
     */
    public function scopeActivated($query)
    {
        return $query->where('activated', true);
    }

    /**
     * Scope to filter by language
     */
    public function scopeByLanguage($query, $language)
    {
        return $query->where('language', $language);
    }

    /**
     * Scope to filter by test name
     */
    public function scopeByName($query, $name)
    {
        return $query->where('name', $name);
    }

    /**
     * Get the formatted price for counselor
     */
    public function getFormattedPriceCounselorAttribute()
    {
        return '₹' . number_format($this->price_counselor);
    }

    /**
     * Get the formatted price for counselee
     */
    public function getFormattedPriceCounseleeAttribute()
    {
        return '₹' . number_format($this->price_counselee);
    }

    /**
     * Check if test has usage (either counselor or counselee counters > 0)
     */
    public function getHasUsageAttribute()
    {
        return $this->counter_counselor > 0 || $this->counter_counselee > 0;
    }

    /**
     * Get total usage count
     */
    public function getTotalUsageAttribute()
    {
        return $this->counter_counselor + $this->counter_counselee;
    }

    /**
     * Get the packages that include this test.
     */
    public function packages(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'package_has_tests')
                    ->withTimestamps();
    }

    /**
     * Get the package-test relationships for this test.
     */
    public function packageHasTests(): HasMany
    {
        return $this->hasMany(PackageHasTest::class);
    }

    /**
     * Get only active packages that include this test.
     */
    public function activePackages(): BelongsToMany
    {
        return $this->packages()->where('status', Package::STATUS_ACTIVE);
    }

    /**
     * Get the total number of packages that include this test.
     */
    public function getPackagesCountAttribute(): int
    {
        return $this->packages()->count();
    }

    /**
     * Get the total number of active packages that include this test.
     */
    public function getActivePackagesCountAttribute(): int
    {
        return $this->activePackages()->count();
    }
}
