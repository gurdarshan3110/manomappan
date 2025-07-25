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
                    
                    @auth
                        <button type="button" class="btn btn-dark" onclick="proceedToPayment()">Pay Now</button>
                    @else
                        <button type="button" class="btn btn-dark" onclick="proceedToAuth()">Continue</button>
                        <p class="mt-2 text-muted text-center">
                            <small>Please login or register to continue with your purchase</small>
                        </p>
                    @endauth
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
        // Redirect to payment page with package ID
        window.location.href = "{{ route('pages.payment') }}?package_id=" + selectedPackage.value;
    } else {
        alert('Please select a package before proceeding.');
    }
}

function proceedToAuth() {
    const selectedPackage = document.querySelector('input[name="selected_package"]:checked');
    if (selectedPackage) {
        // Store the current URL with selected package for redirect after auth
        const currentUrl = window.location.pathname;
        const redirectUrl = encodeURIComponent(currentUrl);
        
        // Directly redirect to login page
        window.location.href = "{{ route('pages.login') }}?redirect_url=" + redirectUrl;
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

<style>
.tests-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 30px;
}

.test-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-left: 4px solid #007bff;
}

.test-item h5 {
    color: #333;
    margin-bottom: 10px;
    font-weight: 600;
}

.test-item p {
    color: #666;
    font-size: 14px;
    margin-bottom: 8px;
}

.career-plan label {
    cursor: pointer;
    transition: all 0.3s ease;
}

.career-plan label:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.career-plan input[type="radio"]:checked + p span {
    color: #007bff;
    font-weight: 600;
}
</style>

@endsection
