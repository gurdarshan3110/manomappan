<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CareerCluster extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'DRAFT';
    public const STATUS_PUBLISHED = 'PUBLISHED';
    public const STATUS_ARCHIVED = 'ARCHIVED';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'thumbnail_alt',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($cluster) {
            if (empty($cluster->slug)) {
                $cluster->slug = Str::slug($cluster->name);
            }
            if (empty($cluster->seo_title)) {
                $cluster->seo_title = $cluster->name;
            }
        });
    }

    public static function getStatusList(): array
    {
        return [
            self::STATUS_DRAFT => __('Draft'),
            self::STATUS_PUBLISHED => __('Published'),
            self::STATUS_ARCHIVED => __('Archived'),
        ];
    }

    public function scopeIsPublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeIsDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeIsArchived($query)
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }
}
