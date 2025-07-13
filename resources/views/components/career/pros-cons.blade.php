@props(['content'])

<div class="grid md:grid-cols-2 gap-6">
    <!-- Pros -->
    @if(!empty($content['pros']))
        <div class="bg-green-50 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-4a2 2 0 012-2h2.5"></path>
                </svg>
                Advantages
            </h3>
            <div class="space-y-3">
                @foreach($content['pros'] as $pro)
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-green-800">{{ $pro['title'] }}</h4>
                            <p class="text-green-700 text-sm mt-1">{{ $pro['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Cons -->
    @if(!empty($content['cons']))
        <div class="bg-red-50 rounded-lg p-6">
            <h3 class="text-xl font-semibold text-red-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l3 3 7-7"></path>
                </svg>
                Disadvantages
            </h3>
            <div class="space-y-3">
                @foreach($content['cons'] as $con)
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-red-800">{{ $con['title'] }}</h4>
                            <p class="text-red-700 text-sm mt-1">{{ $con['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
