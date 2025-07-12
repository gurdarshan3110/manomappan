@props(['items'])

<div class="grid md:grid-cols-2 gap-6">
    @foreach($items as $institution)
        <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                {{ $institution['name'] }}
            </h3>
            <p class="text-gray-600 leading-relaxed">{{ $institution['description'] }}</p>
        </div>
    @endforeach
</div>
