<div class="career-summary-tc">
    <h3 class="">{{ $section['title'] }}</h3>
    @if(!empty($section['content']['items']))
        <div class="row gx-2">
            @foreach($section['content']['items'] as $institution)
                <div class="col-md-4">
                    <div class="section-box-c">
                        <h4>{{ $institution['name'] }}</h4>
                        <p>{{ $institution['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row gx-2">
            <div class="col-md-12">
                <div class="section-box-c">
                    <p>No institutions listed for this career.</p>
                </div>
            </div>
        </div>
    @endif
</div>
