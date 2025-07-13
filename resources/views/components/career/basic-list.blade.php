@props(['items'])

<div class="space-y-4">
    @foreach($items as $item)
        <div class="border-l-4 border-blue-500 pl-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $item['title'] }}</h3>
            <p class="text-gray-600 leading-relaxed">{{ $item['description'] }}</p>
        </div>
    @endforeach
</div>
