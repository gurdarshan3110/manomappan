<div class="timeline-wrapper">
    <h3>{{ $section['title'] }}</h3>
    @if(!empty($section['content']['items']))
        @foreach($section['content']['items'] as $item)
            <div class="row">
                <div class="col-md-12">
                    <div class="section-box time-line {{ $loop->last ? 'last-line' : '' }}">
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['description'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-md-12">
                <div class="section-box time-line">
                    <p>No content available for this section.</p>
                </div>
            </div>
        </div>
    @endif
</div>
