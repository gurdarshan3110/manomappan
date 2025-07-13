@props(['section'])

<div class="career-section mb-8 bg-white rounded-lg shadow-sm border p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $section['title'] }}</h2>
    
    @if($section['type'] === 'CAREER_SUMMARY' || 
        $section['type'] === 'HOW_TO_START' || 
        $section['type'] === 'CAREER_PROSPECTS' || 
        $section['type'] === 'MARKET_TREND_AND_SALARY')
        <x-career.basic-list :items="$section['content']['items']" />
        
    @elseif($section['type'] === 'ENTRANCE_EXAM')
        <x-career.entrance-exam :content="$section['content']" />
        
    @elseif($section['type'] === 'CHALLENGES_AND_SKILL_SET_REQUIRED')
        <x-career.challenges-skills :content="$section['content']" />
        
    @elseif($section['type'] === 'FAQS')
        <x-career.faqs :items="$section['content']['items']" />
        
    @elseif($section['type'] === 'TOP_COLLEGES_INSTITUTIONS_UNIVERSITIES')
        <x-career.institutions :items="$section['content']['items']" />
        
    @elseif($section['type'] === 'PROS_AND_CONS')
        <x-career.pros-cons :content="$section['content']" />
        
    @elseif($section['type'] === 'STALWARTS_OF_THE_CAREER')
        <x-career.stalwarts :items="$section['content']['items']" />
    @endif
</div>
