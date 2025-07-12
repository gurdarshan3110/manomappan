@props(['content'])

<div class="grid md:grid-cols-2 gap-6">
    <!-- Challenges -->
    @if(!empty($content['challenges']))
        <div class="bg-red-50 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-red-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                Challenges
            </h3>
            <div class="space-y-3">
                @foreach($content['challenges'] as $challenge)
                    <div class="border-l-4 border-red-400 pl-3">
                        <h4 class="font-medium text-red-800">{{ $challenge['title'] }}</h4>
                        <p class="text-red-700 text-sm mt-1">{{ $challenge['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Skills Required -->
    @if(!empty($content['skill_set_required']))
        <div class="bg-green-50 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Skills Required
            </h3>
            <div class="space-y-3">
                @foreach($content['skill_set_required'] as $skill)
                    <div class="border-l-4 border-green-400 pl-3">
                        <h4 class="font-medium text-green-800">{{ $skill['title'] }}</h4>
                        <p class="text-green-700 text-sm mt-1">{{ $skill['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
