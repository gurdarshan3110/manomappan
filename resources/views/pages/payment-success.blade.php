@extends('layouts.layout')

@section('content')
<section class="payment-processed aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <div class="row">  
            <div class="col-md-6 offset-md-3">
                <div class="payment-processed-inner">
                    <span>
                        @if($package->icon)
                            <img src="{{ asset('storage/' . $package->icon) }}" alt="{{ $package->plan_name }}">
                        @else
                            @switch($package->plan_name)
                                @case('Career Compass')
                                    <img src="{{ asset('images/compass.png') }}" alt="{{ $package->plan_name }}">
                                    @break
                                @case('Career Navigator')
                                    <img src="{{ asset('images/nav.svg') }}" alt="{{ $package->plan_name }}">
                                    @break
                                @case('Career Superstar')
                                    <img src="{{ asset('images/star.svg') }}" alt="{{ $package->plan_name }}">
                                    @break
                                @default
                                    <img src="{{ asset('images/compass2.png') }}" alt="{{ $package->plan_name }}">
                            @endswitch
                        @endif
                        {{ $package->plan_name }}
                    </span>
                    <h2>Congratulations, {{ $user->first_name }}!</h2>
                    <p>Your Manomaapan <b>{{ $package->plan_name }} Plan is now active!</b> You have taken an important step towards your career journey. <br><br>Click on button below to go to Manomaapan dashboard</p>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-dark">Take me to Manomaapan Dashboard</a>
                </div>
                <h5>Have any trouble? Is your plan not correctly shown? <a href="{{ route('pages.contact') }}"><b>Contact us</b></a></h5>
            </div>
        </div>
    </div>    
</section>
@endsection
