<div class="career-summary-rt">
    <h3 class="">{{ $section['title'] }}</h3>
    @if(!empty($section['content']['items']))
        <div class="row gx-2">
            @foreach($section['content']['items'] as $stalwart)
                <div class="col-md-4">
                    <div class="stalwarts-box">
                        @if(!empty($stalwart['image_url']))
                            <div class="profile-img">
                                <img src="{{ $stalwart['image_url'] }}" alt="{{ $stalwart['name'] }}">
                            </div>
                        @else
                            <div class="profile-name">
                                <h3>{{ substr($stalwart['name'], 0, 2) }}</h3>
                            </div>
                        @endif
                        
                        <h4>{{ $stalwart['name'] }}</h4>
                        
                        @if(!empty($stalwart['instagram_link']) || !empty($stalwart['facebook_link']) || !empty($stalwart['x_link']) || !empty($stalwart['linkedin_link']))
                            <ul>
                                @if(!empty($stalwart['instagram_link']))
                                    <li>
                                        <a href="{{ $stalwart['instagram_link'] }}" target="_blank">
                                            <span><img src="images/insta.png"></span>@{{ $stalwart['name'] }}
                                        </a>
                                    </li>
                                @endif
                                
                                @if(!empty($stalwart['facebook_link']))
                                    <li>
                                        <a href="{{ $stalwart['facebook_link'] }}" target="_blank">
                                            <span><img src="images/facebook.png"></span>@{{ $stalwart['name'] }}
                                        </a>
                                    </li>
                                @endif
                                
                                @if(!empty($stalwart['x_link']))
                                    <li>
                                        <a href="{{ $stalwart['x_link'] }}" target="_blank">
                                            <span><img src="images/twitter.png"></span>@{{ $stalwart['name'] }}
                                        </a>
                                    </li>
                                @endif
                                
                                @if(!empty($stalwart['linkedin_link']))
                                    <li>
                                        <a href="{{ $stalwart['linkedin_link'] }}" target="_blank">
                                            <span><img src="images/linkedin.png"></span>@{{ $stalwart['name'] }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                        
                        <p>{{ $stalwart['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row gx-2">
            <div class="col-md-12">
                <div class="stalwarts-box">
                    <p>No stalwarts information available for this career.</p>
                </div>
            </div>
        </div>
    @endif
</div>
