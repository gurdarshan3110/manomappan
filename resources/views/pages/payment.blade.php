@extends('layouts.layout')

@section('content')
<section class="payment-section" style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                @if($errors->any() || session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Error!</strong> 
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                @if($selectedPackage)
                <div class="row">
                    <!-- Order Summary Card -->
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-header bg-white border-0 py-4">
                                <h4 class="mb-0 text-center">
                                    <i class="fas fa-credit-card text-primary me-2"></i>
                                    Complete Your Payment
                                </h4>
                            </div>
                            <div class="card-body p-4">
                                
                                <!-- Package Details Section -->
                                <div class="mb-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-box me-2"></i>Package Details
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="package-info">
                                                <p><strong>Plan:</strong> <span class="text-primary">{{ $selectedPackage->plan_name }}</span></p>
                                                <p><strong>Price:</strong> <span class="text-success">₹ {{ number_format($selectedPackage->price) }}</span></p>
                                                <p><strong>Counsellor:</strong> {{ $selectedPackage->counsellor ?? 'Professional Counsellor' }}</p>
                                                @if($selectedPackage->duration)
                                                    <p><strong>Duration:</strong> {{ $selectedPackage->duration }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if($selectedPackage->tests && $selectedPackage->tests->count() > 0)
                                                <div class="tests-included">
                                                    <p><strong>Included Tests:</strong></p>
                                                    <ul class="list-unstyled ms-3">
                                                        @foreach($selectedPackage->tests->take(3) as $test)
                                                            <li><i class="fas fa-check text-success me-2"></i>{{ $test->display_name }}</li>
                                                        @endforeach
                                                        @if($selectedPackage->tests->count() > 3)
                                                            <li><i class="fas fa-plus text-info me-2"></i>{{ $selectedPackage->tests->count() - 3 }} more tests</li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <!-- Payment Methods Section -->
                                <div class="mb-4">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-credit-card me-2"></i>Payment Options
                                    </h5>
                                    <div class="payment-methods">
                                        <div class="row text-center">
                                            <div class="col-6 col-md-3 mb-3">
                                                <div class="payment-method-item">
                                                    <i class="fas fa-credit-card fa-2x text-primary mb-2"></i>
                                                    <p class="small mb-0">Credit Card</p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 mb-3">
                                                <div class="payment-method-item">
                                                    <i class="fas fa-university fa-2x text-info mb-2"></i>
                                                    <p class="small mb-0">Net Banking</p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 mb-3">
                                                <div class="payment-method-item">
                                                    <i class="fas fa-mobile-alt fa-2x text-success mb-2"></i>
                                                    <p class="small mb-0">UPI</p>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 mb-3">
                                                <div class="payment-method-item">
                                                    <i class="fas fa-wallet fa-2x text-warning mb-2"></i>
                                                    <p class="small mb-0">Wallets</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Razorpay Payment Form -->
                                <div class="text-center">
                                    <form action="{{ route('razorpay.payment.store') }}" method="POST" id="payment-form">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $selectedPackage->id }}">
                                        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                                        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
                                        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
                                        
                                        <button type="button" class="btn btn-primary btn-lg px-5 py-3" id="pay-button">
                                            <i class="fas fa-lock me-2"></i>
                                            Pay ₹ {{ number_format($selectedPackage->price) }} Securely
                                        </button>
                                        
                                        <p class="small text-muted mt-3">
                                            <i class="fas fa-shield-alt text-success me-1"></i>
                                            Secured by Razorpay • 256-bit SSL Encryption
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Sidebar -->
                    <div class="col-lg-4">
                        <div class="card shadow border-0 sticky-top bg-white" style="top: 20px;">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-receipt me-2"></i>Order Summary
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="order-item d-flex justify-content-between mb-3">
                                    <div>
                                        <h6 class="mb-1">{{ $selectedPackage->plan_name }}</h6>
                                        <p class="text-muted small mb-0">Career Counselling Package</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="mb-0 fw-bold">₹ {{ number_format($selectedPackage->price) }}</p>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="total-section">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Subtotal:</span>
                                        <span>₹ {{ number_format($selectedPackage->price) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tax:</span>
                                        <span class="text-success">Included</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                        <span>Total:</span>
                                        <span class="text-primary">₹ {{ number_format($selectedPackage->price) }}</span>
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <a href="{{ route('pages.buy_package', $selectedPackage->id) }}" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Package Selection
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="card shadow-sm border-0 mt-4">
                            <div class="card-body text-center">
                                <h6 class="text-primary mb-3">Why Choose Us?</h6>
                                <div class="trust-indicators">
                                    <div class="mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <small>100% Secure Payments</small>
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-user-shield text-primary me-2"></i>
                                        <small>Expert Counsellors</small>
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-award text-warning me-2"></i>
                                        <small>Trusted by 10,000+ Students</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center">
                    <div class="card shadow border-0">
                        <div class="card-body p-5">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h4>No Package Selected</h4>
                            <p class="text-muted">Please select a package to continue with payment.</p>
                            <a href="{{ route('pages.buy_package') }}" class="btn btn-primary">
                                <i class="fas fa-box me-2"></i>Choose a Package
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@if($selectedPackage)
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.getElementById('pay-button').addEventListener('click', function() {
    // First create order
    fetch('{{ route("razorpay.order.create") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            package_id: {{ $selectedPackage->id }}
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}",
                "amount": data.amount,
                "currency": data.currency,
                "name": "Manomaapan",
                "description": "{{ $selectedPackage->plan_name }} - Career Counselling Package",
                "order_id": data.order_id,
                "handler": function (response) {
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;
                    document.getElementById('payment-form').submit();
                },
                "prefill": {
                    "name": "{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}",
                    "email": "{{ Auth::user()->email }}",
                    "contact": "{{ Auth::user()->phone ?? '' }}"
                },
                "notes": {
                    "package_id": "{{ $selectedPackage->id }}",
                    "package_name": "{{ $selectedPackage->plan_name }}"
                },
                "theme": {
                    "color": "#667eea"
                },
                "modal": {
                    "ondismiss": function() {
                        console.log('Payment modal dismissed');
                    }
                }
            };
            
            var rzp = new Razorpay(options);
            rzp.open();
        } else {
            alert('Failed to create order. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again.');
    });
});
</script>
@endif

<style>
.payment-section {
    min-height: 100vh;
}

.card {
    border-radius: 15px;
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.payment-method-item {
    padding: 15px;
    border-radius: 10px;
    background: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.payment-method-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.package-info p {
    margin-bottom: 0.5rem;
    padding: 0.25rem 0;
}

.order-item {
    padding: 10px 0;
}

.trust-indicators small {
    font-size: 0.875rem;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

@media (max-width: 768px) {
    .sticky-top {
        position: relative !important;
        top: auto !important;
    }
    
    .payment-section {
        padding: 30px 0 !important;
    }
}
</style>
@endsection
