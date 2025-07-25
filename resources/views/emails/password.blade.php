@extends('emails.layout')

@section('title', 'Your Account Password')

@section('content')
    <div class="greeting">
        Hello {{ $user->name }},
    </div>

    <div class="content-section">
        <p>
            Your Manomaapan account has been set up successfully! Below are your login credentials:
        </p>
    </div>

    <div class="info-box">
        <h3>🔐 Your Login Credentials</h3>
        <p>
            <strong>Email:</strong> {{ $user->email }}<br>
            <strong>Password:</strong> <code style="background: #f1f1f1; padding: 5px 10px; border-radius: 3px; font-family: monospace; font-size: 16px; color: #e74c3c; font-weight: bold;">{{ $password }}</code>
        </p>
    </div>

    <div class="highlight">
        <strong>🛡️ Important Security Notice:</strong>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li>Please change your password after your first login</li>
            <li>Keep your login credentials secure and confidential</li>
            <li>Never share your password with anyone</li>
            <li>Use a strong, unique password for better security</li>
        </ul>
    </div>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}/login" class="btn">
            Login to Your Account
        </a>
    </div>

    <div class="content-section">
        <h2>Next Steps:</h2>
        <p>
            <strong>1.</strong> Click the login button above to access your account<br>
            <strong>2.</strong> Change your password in your profile settings<br>
            <strong>3.</strong> Complete your profile for better recommendations<br>
            <strong>4.</strong> Start your career assessment journey
        </p>
    </div>

    <div class="content-section">
        <p>
            If you didn't request this account or have any concerns, please contact our support team immediately.
        </p>

        <p>
            <strong>Need Help?</strong><br>
            If you have trouble logging in or need assistance, our support team is ready to help you.
        </p>

        <p>
            Best regards,<br>
            <strong>The Manomaapan Team</strong>
        </p>
    </div>
@endsection
