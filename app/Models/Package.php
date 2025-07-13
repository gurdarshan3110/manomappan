<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
