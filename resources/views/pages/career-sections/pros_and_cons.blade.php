<div class="row">
    <div class="col-md-6">
        <div class="career-summary-rt">
            <h3>Pros</h3>
            @if(!empty($section['content']['pros']))
                @foreach($section['content']['pros'] as $pro)
                    <div class="section-box">
                        <h4>{{ $pro['title'] }}</h4>
                        <p>{{ $pro['description'] }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="career-summary-rt c">
            <h3>Cons</h3>
            @if(!empty($section['content']['cons']))
                @foreach($section['content']['cons'] as $con)
                    <div class="section-box-c">
                        <h4>{{ $con['title'] }}</h4>
                        <p>{{ $con['description'] }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
