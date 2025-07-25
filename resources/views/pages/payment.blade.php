@extends('layouts.layout')

@section('content')
<section class="payment-section" style="padding: 60px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center mb-4">
                    <h2>Complete Your Payment</h2>
                    @if($selectedPackage)
                        <p>You are purchasing: <strong>{{ $selectedPackage->plan_name }}</strong></p>
                        <h3>Amount: ₹ {{ number_format($selectedPackage->price) }}</h3>
                    @else
                        <p>No package selected. <a href="{{ route('pages.buy_package') }}">Choose a package</a></p>
                    @endif
                </div>
                
                @if($selectedPackage)
                <div class="payment-form">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Package Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Plan:</strong> {{ $selectedPackage->plan_name }}<br>
                                    <strong>Price:</strong> ₹ {{ number_format($selectedPackage->price) }}<br>
                                    <strong>Counsellor:</strong> {{ $selectedPackage->counsellor ?? 'Professional' }}<br>
                                </div>
                                <div class="col-md-6">
                                    @if($selectedPackage->tests->count() > 0)
                                        <strong>Included Tests:</strong>
                                        <ul style="margin-top: 5px;">
                                            @foreach($selectedPackage->tests->take(3) as $test)
                                                <li>{{ $test->display_name }}</li>
                                            @endforeach
                                            @if($selectedPackage->tests->count() > 3)
                                                <li>+ {{ $selectedPackage->tests->count() - 3 }} more tests</li>
                                            @endif
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Payment Gateway Integration</h5>
                            <p class="text-muted">Payment gateway integration will be implemented here.</p>
                            <p>You can pay by:</p>
                            <ul>
                                <li>Debit Card</li>
                                <li>Credit Card</li>
                                <li>UPI</li>
                                <li>Net Banking</li>
                                <li>EMI Options</li>
                            </ul>
                            
                            <div class="mt-4">
                                <button class="btn btn-primary btn-lg" disabled>
                                    Pay ₹ {{ number_format($selectedPackage->price) }} (Coming Soon)
                                </button>
                                <a href="{{ route('pages.buy_package', $selectedPackage->id) }}" class="btn btn-secondary btn-lg ms-2">
                                    Back to Package Selection
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
