@extends('emails.layout')

@section('title', 'Payment Successful')

@section('content')
    <div class="greeting">
        Congratulations {{ $user->name }}! 🎉
    </div>

    <div class="success-badge">
        ✅ Payment Successful
    </div>

    <div class="content-section">
        <p>
            Your payment for <strong>{{ $payment->package->plan_name }}</strong> has been processed successfully! 
            You now have access to all the features included in your package.
        </p>
    </div>

    <div class="info-box">
        <h3>📋 Payment Details</h3>
        <table class="table">
            <tr>
                <td><strong>Package:</strong></td>
                <td>{{ $payment->package->plan_name }}</td>
            </tr>
            <tr>
                <td><strong>Amount Paid:</strong></td>
                <td>₹{{ number_format($payment->amount) }}</td>
            </tr>
            <tr>
                <td><strong>Payment ID:</strong></td>
                <td>{{ $payment->payment_id }}</td>
            </tr>
            <tr>
                <td><strong>Order ID:</strong></td>
                <td>{{ $payment->order_id }}</td>
            </tr>
            <tr>
                <td><strong>Payment Date:</strong></td>
                <td>{{ $payment->created_at->format('M d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td><span style="color: #28a745; font-weight: bold;">{{ ucfirst($payment->status) }}</span></td>
            </tr>
        </table>
    </div>

    <div class="content-section">
        <h2>🎯 What's Included in Your Package?</h2>
        <p>{{ $payment->package->description }}</p>
        
        @if($payment->package->features)
            <ul style="margin: 15px 0; padding-left: 20px; color: #555;">
                @foreach(json_decode($payment->package->features, true) ?? [] as $feature)
                    <li style="margin-bottom: 8px;">✓ {{ $feature }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}/user/dashboard" class="btn">
            Access Your Dashboard
        </a>
    </div>

    <div class="highlight">
        <strong>📄 Receipt Attached:</strong> Your payment receipt has been attached to this email as a PDF for your records.
    </div>

    <div class="content-section">
        <h2>🚀 Next Steps:</h2>
        <p>
            <strong>1.</strong> Access your dashboard to start using your package features<br>
            <strong>2.</strong> Complete our comprehensive career assessment<br>
            <strong>3.</strong> Schedule your counseling sessions<br>
            <strong>4.</strong> Explore career recommendations tailored for you
        </p>
    </div>

    <div class="content-section">
        <p>
            We're excited to be part of your career discovery journey! Our team of expert counselors 
            is ready to guide you toward finding your perfect career path.
        </p>

        <p>
            If you have any questions about your package or need assistance, please don't hesitate 
            to reach out to our support team.
        </p>

        <p>
            Thank you for choosing Manomaapan!
        </p>

        <p>
            <strong>The Manomaapan Team</strong>
        </p>
    </div>
@endsection
