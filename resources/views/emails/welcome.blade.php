@extends('emails.layout')

@section('title', 'Welcome to Manomaapan')

@section('content')
    <div class="greeting">
        Welcome to Manomaapan, {{ $user->name }}! 🎉
    </div>

    <div class="content-section">
        <p>
            We're thrilled to have you join our community of students who are discovering their true career potential! 
            Your journey toward finding the perfect career path starts here.
        </p>
    </div>

    <div class="info-box">
        <h3>🎯 What's Next?</h3>
        <p>
            <strong>1. Complete Your Profile:</strong> Add more details to get personalized recommendations<br>
            <strong>2. Take Our Assessment:</strong> Discover your strengths, interests, and aptitude<br>
            <strong>3. Get Expert Guidance:</strong> Connect with our career counselors<br>
            <strong>4. Explore Career Paths:</strong> Find careers that match your potential
        </p>
    </div>

    <div class="content-section">
        <h2>Why Choose Manomaapan?</h2>
        <p>
            ✅ <strong>Scientific Approach:</strong> Our assessments are designed with leading researchers<br>
            ✅ <strong>Native Language Support:</strong> Available in Gujarati, Hindi, and English<br>
            ✅ <strong>Expert Guidance:</strong> Professional career counselors at your service<br>
            ✅ <strong>Personalized Results:</strong> Career recommendations based on your unique strengths
        </p>
    </div>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ config('app.url') }}/login" class="btn">
            Start Your Career Journey
        </a>
    </div>

    <div class="highlight">
        <strong>💡 Pro Tip:</strong> Take our comprehensive assessment in your preferred language to get the most accurate career recommendations!
    </div>

    <div class="content-section">
        <p>
            If you have any questions or need assistance, our support team is here to help you every step of the way.
        </p>
        
        <p>
            Welcome aboard and best of luck with your career discovery!
        </p>

        <p>
            <strong>The Manomaapan Team</strong>
        </p>
    </div>
@endsection
