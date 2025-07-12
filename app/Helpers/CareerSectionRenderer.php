<?php

namespace App\Helpers;

use App\Models\CareerSection;
use Illuminate\Support\Facades\Storage;

class CareerSectionRenderer
{
    /**
     * Render a career section based on its type
     */
    public static function render(CareerSection $section): array
    {
        $data = $section->form_data ?? [];
        $type = $section->form_type;

        return [
            'type' => $type,
            'title' => CareerSection::CAREER_FORM_TYPE[$type] ?? 'Unknown Section',
            'content' => self::renderContent($type, $data),
            'order' => $section->section_order,
        ];
    }

    /**
     * Render content based on section type
     */
    private static function renderContent(string $type, array $data): array
    {
        switch ($type) {
            case 'CAREER_SUMMARY':
            case 'HOW_TO_START':
            case 'CAREER_PROSPECTS':
            case 'MARKET_TREND_AND_SALARY':
                return [
                    'items' => $data['items'] ?? [],
                ];

            case 'ENTRANCE_EXAM':
                return [
                    'items' => $data['items'] ?? [],
                    'difficulty_level' => $data['difficulty_level'] ?? '',
                    'preparation_tips' => $data['preparation_tips'] ?? '',
                ];

            case 'CHALLENGES_AND_SKILL_SET_REQUIRED':
                return [
                    'challenges' => $data['challenges']['items'] ?? [],
                    'skill_set_required' => $data['skill_set_required']['items'] ?? [],
                ];

            case 'FAQS':
                return [
                    'items' => $data['items'] ?? [],
                ];

            case 'TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES':
                return [
                    'items' => $data['items'] ?? [],
                ];

            case 'PROS_AND_CONS':
                return [
                    'pros' => $data['pros']['items'] ?? [],
                    'cons' => $data['cons']['items'] ?? [],
                ];

            case 'STALWARTS_OF_THE_CAREER':
                $items = $data['items'] ?? [];
                // Process image URLs
                foreach ($items as &$item) {
                    if (!empty($item['image'])) {
                        $item['image_url'] = Storage::url($item['image']);
                    }
                }
                return [
                    'items' => $items,
                ];

            default:
                return $data;
        }
    }

    /**
     * Get all rendered sections for a career
     */
    public static function getAllSections($career): array
    {
        return $career->sections()
            ->orderBy('section_order')
            ->get()
            ->map(function ($section) {
                return self::render($section);
            })
            ->toArray();
    }

    /**
     * Get a specific section type for a career
     */
    public static function getSectionByType($career, string $type): ?array
    {
        $section = $career->sections()
            ->where('form_type', $type)
            ->first();

        return $section ? self::render($section) : null;
    }
}
