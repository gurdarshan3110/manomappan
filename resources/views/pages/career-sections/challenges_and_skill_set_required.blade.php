<div class="row">
    <div class="col-md-6">
        <div class="career-summary-rt c">
            <h3>Challenges</h3>
            @if(!empty($section['content']['challenges']))
                @foreach($section['content']['challenges'] as $challenge)
                    <div class="section-box-c">
                        <h4>{{ $challenge['title'] }}</h4>
                        <p>{!! $challenge['description'] !!}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="career-summary-rt">
            <h3>Skills Required</h3>
            @if(!empty($section['content']['skill_set_required']))
                @foreach($section['content']['skill_set_required'] as $skill)
                    <div class="section-box">
                        <h4>{{ $skill['title'] }}</h4>
                        <p>{!! $skill['description'] !!}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
