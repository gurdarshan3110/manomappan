<h3 class="faq-title">{{ $section['title'] }}</h3>

<div class="accordion" id="marketAccordion">
    @if(!empty($section['content']['items']))
        @foreach($section['content']['items'] as $index => $item)
            <div class="accordion-item mb-3 rounded">
                <h2 class="accordion-header" id="marketHeading{{ $index }}">
                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#marketCollapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="marketCollapse{{ $index }}">
                        {{ $item['title'] }}
                    </button>
                </h2>
                <div id="marketCollapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="marketHeading{{ $index }}" data-bs-parent="#marketAccordion">
                    <div class="accordion-body">
                        <p>{!! $item['description'] !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="accordion-item mb-3 rounded">
            <h2 class="accordion-header" id="marketHeadingEmpty">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#marketCollapseEmpty" aria-expanded="true" aria-controls="marketCollapseEmpty">
                    No Market Data Available
                </button>
            </h2>
            <div id="marketCollapseEmpty" class="accordion-collapse collapse show" aria-labelledby="marketHeadingEmpty" data-bs-parent="#marketAccordion">
                <div class="accordion-body">
                    <p>No market trend and salary information is available for this career.</p>
                </div>
            </div>
        </div>
    @endif
</div>
