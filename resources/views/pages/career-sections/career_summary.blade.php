<div class="career-summary-rt">
    <h3>{{ $section['title'] }}</h3>
    @if(!empty($section['content']['items']))
        @foreach($section['content']['items'] as $item)
            <div class="section-box">
                <h4>{{ $item['title'] }}</h4>
                <p>{!! $item['description'] !!}</p>
            </div>
        @endforeach
    @else
        <div class="section-box">
            <p>No content available for this section.</p>
        </div>
    @endif
</div>
