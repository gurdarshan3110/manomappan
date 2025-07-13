@props(['items'])

<div class="space-y-4">
    @foreach($items as $index => $faq)
        <div class="border border-gray-200 rounded-lg">
            <button class="w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition-colors duration-200" 
                    onclick="toggleFaq({{ $index }})">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-800">{{ $faq['question'] }}</h3>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" 
                         id="faq-icon-{{ $index }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </button>
            <div class="px-6 py-4 border-t border-gray-200 hidden" id="faq-answer-{{ $index }}">
                <p class="text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
            </div>
        </div>
    @endforeach
</div>

<script>
function toggleFaq(index) {
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    
    if (answer.classList.contains('hidden')) {
        answer.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        answer.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
