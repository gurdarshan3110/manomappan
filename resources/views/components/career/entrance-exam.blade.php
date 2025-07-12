@props(['content'])

<div class="space-y-6">
    <!-- Exam Information -->
    @if(!empty($content['items']))
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Exam Information</h3>
            <div class="space-y-3">
                @foreach($content['items'] as $item)
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <h4 class="font-medium text-gray-800">{{ $item['title'] }}</h4>
                        <p class="text-gray-600 mt-1">{{ $item['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Difficulty Level -->
    @if(!empty($content['difficulty_level']))
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Difficulty Level</h3>
            <div class="prose max-w-none">
                {!! $content['difficulty_level'] !!}
            </div>
        </div>
    @endif

    <!-- Preparation Tips -->
    @if(!empty($content['preparation_tips']))
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Preparation Tips</h3>
            <div class="prose max-w-none">
                {!! $content['preparation_tips'] !!}
            </div>
        </div>
    @endif
</div>
