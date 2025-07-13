<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'form_type',
        'form_data',
        'section_title',
        'section_content',
        'section_image',
        'section_order'
    ];

    protected $casts = [
        'form_data' => 'array'
    ];

    public const CAREER_FORM_TYPE = [
        'CAREER_SUMMARY' => 'Career Summary',
        'HOW_TO_START' => 'How to Start',
        'ENTRANCE_EXAM' => 'Entrance Exam',
        'CAREER_PROSPECTS' => 'Career Prospects',
        'CHALLENGES_AND_SKILL_SET_REQUIRED' => 'Challenges and Skill Set Required',
        'FAQS' => 'FAQs',
        'TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES' => 'Top Colleges / Institutions / Universities',
        'MARKET_TREND_AND_SALARY' => 'Market Trend and Salary',
        'PROS_AND_CONS' => 'Pros and Cons',
        'STALWARTS_OF_THE_CAREER' => 'Stalwarts of the Career',
    ];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public static function getTypeList(): array
    {
        return self::CAREER_FORM_TYPE;
    }

    public function getFormTypeLabel(): string
    {
        return self::CAREER_FORM_TYPE[$this->form_type] ?? 'Unknown';
    }

    // Get form schema based on type
    public static function getFormSchemaForType(string $type): array
    {
        switch ($type) {
            case self::CAREER_FORM_TYPE['CAREER_SUMMARY']:
            case self::CAREER_FORM_TYPE['HOW_TO_START']:
            case self::CAREER_FORM_TYPE['CAREER_PROSPECTS']:
            case self::CAREER_FORM_TYPE['MARKET_TREND_AND_SALARY']:
                return [
                    'items' => [
                        'title' => 'string',
                        'description' => 'text'
                    ]
                ];

            case self::CAREER_FORM_TYPE['ENTRANCE_EXAM']:
                return [
                    'items' => [
                        'title' => 'string',
                        'description' => 'text'
                    ],
                    'difficulty_level' => 'rich_text',
                    'preparation_tips' => 'rich_text'
                ];

            case self::CAREER_FORM_TYPE['CHALLENGES_AND_SKILL_SET_REQUIRED']:
                return [
                    'challenges' => [
                        'items' => [
                            'title' => 'string',
                            'description' => 'text'
                        ]
                    ],
                    'skill_set_required' => [
                        'items' => [
                            'title' => 'string',
                            'description' => 'text'
                        ]
                    ]
                ];

            case self::CAREER_FORM_TYPE['FAQS']:
                return [
                    'items' => [
                        'question' => 'string',
                        'answer' => 'text'
                    ]
                ];

            case self::CAREER_FORM_TYPE['TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES']:
                return [
                    'items' => [
                        'name' => 'string',
                        'description' => 'text'
                    ]
                ];

            case self::CAREER_FORM_TYPE['PROS_AND_CONS']:
                return [
                    'pros' => [
                        'items' => [
                            'title' => 'string',
                            'description' => 'text'
                        ]
                    ],
                    'cons' => [
                        'items' => [
                            'title' => 'string',
                            'description' => 'text'
                        ]
                    ]
                ];

            case self::CAREER_FORM_TYPE['STALWARTS_OF_THE_CAREER']:
                return [
                    'items' => [
                        'name' => 'string',
                        'image' => 'file',
                        'description' => 'text',
                        'instagram_link' => 'url',
                        'facebook_link' => 'url',
                        'x_link' => 'url',
                        'linkedin_link' => 'url'
                    ]
                ];

            default:
                return [];
        }
    }
    
}
