<h3 class="faq-title">{{ $section['title'] }}</h3>

<div class="accordion" id="faqAccordion">
    @if(!empty($section['content']['items']))
        @foreach($section['content']['items'] as $index => $faq)
            <div class="accordion-item mb-3 rounded">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                        {{ $faq['question'] }}
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        <p>{{ $faq['answer'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="accordion-item mb-3 rounded">
            <h2 class="accordion-header" id="headingEmpty">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmpty" aria-expanded="true" aria-controls="collapseEmpty">
                    No FAQs Available
                </button>
            </h2>
            <div id="collapseEmpty" class="accordion-collapse collapse show" aria-labelledby="headingEmpty" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p>No frequently asked questions are available for this section.</p>
                </div>
            </div>
        </div>
    @endif
</div>
