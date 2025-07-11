<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Career extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'DRAFT';
    public const STATUS_PUBLISHED = 'PUBLISHED';
    public const STATUS_ARCHIVED = 'ARCHIVED';

    protected $fillable = [
        'title',
        'slug',
        'cluster_id',
        'thumbnail',
        'thumbnail_alt',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
        'meta_keywords'
    ];

    public const CAREER_FORM_TYPE = [
        'CAREER_SUMMARY' => 'Career Summary',
        'HOW_TO_START' => 'How to Start',
        'ENTRANCE_EXAM' => 'Entrance Exam',
        'CAREER_PROSPECTS' => 'Career Prospects',
        'CHALLENGES_AND_SKILL_SET_REQUIRED' => 'Challenges and Skill Set Required',
        'FAQS' => 'FAQs',
        'TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES' => 'Top colleges / institutions / universitiies',
        'MARKET_TREND_AND_SALARY' => 'Market Trend and Salary',
        'PROS_AND_CONS' => 'Pros and Cons',
        'STALWARTS_OF_THE_CAREER' => 'Stalwarts of the Career',
    ];

    protected $appends = ['thumbnail_url'];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->title);
            }
            if (empty($career->seo_title)) {
                $career->seo_title = $career->title;
            }
        });
    }

    public function getTypeList(): array
    {
        return array_keys(self::CAREER_FORM_TYPE);
    }

    public function cluster()
    {
        return $this->belongsTo(CareerCluster::class);
    }

    public function sections()
    {
        return $this->hasMany(CareerSection::class)->orderBy('section_order');
    }

    public function relatedCareers()
    {
        return $this->belongsToMany(Career::class, 'career_related', 'career_id', 'related_career_id');
    }

    public static function getStatusList(): array
    {
        return [
            self::STATUS_DRAFT => __('Draft'),
            self::STATUS_PUBLISHED => __('Published'),
            self::STATUS_ARCHIVED => __('Archived'),
        ];
    }

    //if thumbail is not set, return a default image path
    public function getThumbnailUrlAttribute()
    {
        if (empty($this->thumbnail)) {
            return asset('images/blank-img.png');
        }

        return Storage::url($this->thumbnail);
    }
}
