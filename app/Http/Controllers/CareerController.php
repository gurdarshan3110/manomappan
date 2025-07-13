<?php

namespace App\Http\Controllers;

use App\Helpers\CareerSectionRenderer;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a specific career with all its sections
     */
    public function show(Career $career)
    {
        // Get all rendered sections for the career
        $sections = CareerSectionRenderer::getAllSections($career);
        
        return view('careers.show', [
            'career' => $career,
            'sections' => $sections
        ]);
    }

    /**
     * Get specific section data via API
     */
    public function getSectionData(Career $career, string $sectionType)
    {
        $section = CareerSectionRenderer::getSectionByType($career, $sectionType);
        
        if (!$section) {
            return response()->json(['error' => 'Section not found'], 404);
        }

        return response()->json($section);
    }

    /**
     * Example: Get only FAQs for a career
     */
    public function getFaqs(Career $career)
    {
        $faqSection = CareerSectionRenderer::getSectionByType($career, 'FAQS');
        
        return response()->json($faqSection ? $faqSection['content']['items'] : []);
    }

    /**
     * Example: Get career summary
     */
    public function getSummary(Career $career)
    {
        $summarySection = CareerSectionRenderer::getSectionByType($career, 'CAREER_SUMMARY');
        
        return response()->json($summarySection ? $summarySection['content']['items'] : []);
    }
}
