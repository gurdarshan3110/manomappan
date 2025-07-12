<div class="row">
    <div class="col-md-8">
        <div class="career-summary-rt">
            <h3>{{ $section['title'] }}</h3>
            @if(!empty($section['content']['items']))
                @foreach($section['content']['items'] as $item)
                    <div class="section-box">
                        <h4>{{ $item['title'] }}</h4>
                        <p>{{ $item['description'] }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="difficulty-level">
            @if(!empty($section['content']['difficulty_level']))
                <h3>Difficulty Level</h3>
                <div class="section-box-d">
                    {!! $section['content']['difficulty_level'] !!}
                </div>
            @endif
            
            @if(!empty($section['content']['preparation_tips']))
                <h3 class="mt-3">Preparation Tips</h3>
                <div class="section-box-d d2">
                    {!! $section['content']['preparation_tips'] !!}
                </div>
            @endif
        </div>
    </div>
</div>
