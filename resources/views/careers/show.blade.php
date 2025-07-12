@extends('layouts.app')

@section('title', $career->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Career Header -->
    <div class="bg-white rounded-lg shadow-sm border p-8 mb-8">
        <div class="flex flex-col md:flex-row gap-6">
            @if($career->thumbnail_url)
                <div class="md:w-1/3">
                    <img src="{{ $career->thumbnail_url }}" 
                         alt="{{ $career->thumbnail_alt ?? $career->title }}" 
                         class="w-full h-64 object-cover rounded-lg">
                </div>
            @endif
            
            <div class="md:w-2/3">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $career->title }}</h1>
                
                @if($career->cluster)
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full mb-4">
                        {{ $career->cluster->name }}
                    </span>
                @endif
                
                @if($career->seo_description)
                    <p class="text-lg text-gray-600 leading-relaxed">{{ $career->seo_description }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Career Sections -->
    @if(!empty($sections))
        <div class="space-y-8">
            @foreach($sections as $section)
                <x-career.section :section="$section" />
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
            <svg class="w-12 h-12 text-yellow-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="text-lg font-medium text-yellow-800 mb-2">No sections available</h3>
            <p class="text-yellow-600">This career doesn't have any sections configured yet.</p>
        </div>
    @endif

    <!-- Related Careers -->
    @if($career->relatedCareers->count() > 0)
        <div class="mt-12 bg-white rounded-lg shadow-sm border p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Careers</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($career->relatedCareers as $relatedCareer)
                    <a href="{{ route('careers.show', $relatedCareer) }}" 
                       class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-4 transition-colors duration-200">
                        <h3 class="font-medium text-gray-800">{{ $relatedCareer->title }}</h3>
                        @if($relatedCareer->cluster)
                            <span class="text-sm text-gray-600">{{ $relatedCareer->cluster->name }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .prose {
        max-width: none;
    }
    
    .prose h1,
    .prose h2,
    .prose h3,
    .prose h4,
    .prose h5,
    .prose h6 {
        color: inherit;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .prose p {
        margin-bottom: 1rem;
        line-height: 1.7;
    }
    
    .prose ul,
    .prose ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
    
    .prose li {
        margin-bottom: 0.25rem;
    }
</style>
@endpush
