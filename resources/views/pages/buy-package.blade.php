@extends('layouts.layout')

@section('content')
<section class="sign-up aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 aos-init aos-animate" data-aos="fade-down" data-aos-delay="300">
                <div class="journey payment-left">
                    <h2>Hello {{ auth()->user()->name ?? 'there' }}, <br>
                        Glad to see you starting journey towards your excellent career...</h2>
                    <img src="{{ asset('images/sun-img2.png') }}" class="img-fluid aos-init aos-animate" data-aos="zoom-in" data-aos-delay="500">
                </div>
            </div>
            <div class="col-md-6">
                <div class="career-plan">
                    <h3>Just a couple of more steps...</h3>
                    <span>Your Career Plan</span>
                    <form id="packageForm" method="GET">
                        @foreach($packages as $package)
                        <label for="package_{{ $package->id }}">
                            <div class="career-plan-left">
                                <input 
                                    name="selected_package" 
                                    type="radio" 
                                    id="package_{{ $package->id }}"
                                    value="{{ $package->id }}" 
                                    data-price="{{ $package->price }}"
                                    data-formatted-price="₹ {{ number_format($package->price) }}"
                                    {{ $selectedPackageId == $package->id ? 'checked="checked"' : '' }}
                                    onchange="updatePrice(this)"
                                >
                                <p>
                                    <span>{{ $package->plan_name }}</span>
                                    {{ $package->description ?? 'Best for people who want comprehensive career counselling' }}
                                </p>
                            </div>    
                            <div class="career-plan-right">
                                <span>₹ {{ number_format($package->price) }}</span>
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
                                            <img src="{{ asset('images/compass.png') }}" alt="{{ $package->plan_name }}">
                                    @endswitch
                                @endif
                            </div>
                        </label>
                        @endforeach
                    </form>
                    
                    <div class="payment-option">
                        <a href="{{ route('pages.home') }}#our-plans">Read more about plans</a>
                        <h5>Payment information</h5>
                        <div class="total-amount">
                            <span>Total amount payable</span>
                            <h2 id="totalPrice">₹ {{ $selectedPackage ? number_format($selectedPackage->price) : '0' }}</h2>
                            <p>You can pay by debit card, credit card, UPI and net banking EMI Options available.</p> 
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-dark" onclick="proceedToPayment()">Pay Now</button>
                </div>
            </div>
        </div>
    </div>    
</section>

<script>
function updatePrice(radio) {
    const totalPriceElement = document.getElementById('totalPrice');
    const formattedPrice = radio.getAttribute('data-formatted-price');
    totalPriceElement.textContent = formattedPrice;
    
    // Update URL without page reload to reflect selection
    const newUrl = new URL(window.location);
    newUrl.pathname = `/buy-package/${radio.value}`;
    window.history.replaceState({}, '', newUrl);
}

function proceedToPayment() {
    const selectedPackage = document.querySelector('input[name="selected_package"]:checked');
    if (selectedPackage) {
        // For now, just redirect to payment page - you can modify this later
        window.location.href = "{{ route('pages.payment') }}?package_id=" + selectedPackage.value;
    } else {
        alert('Please select a package before proceeding.');
    }
}

// Auto-select first package if none is selected
document.addEventListener('DOMContentLoaded', function() {
    const selectedRadio = document.querySelector('input[name="selected_package"]:checked');
    if (!selectedRadio) {
        const firstRadio = document.querySelector('input[name="selected_package"]');
        if (firstRadio) {
            firstRadio.checked = true;
            updatePrice(firstRadio);
        }
    }
});
</script>

@endsection
