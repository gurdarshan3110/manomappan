@extends('layouts.layout')

@section('content')
    <section class="sign-up" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-down" data-aos-delay="300">
                    <div class="journey">
                        <h1>Your journey to a fulfilling career starts here.</h1>
                        <img src="images/sun-img1.png" class="img-fluid" data-aos="zoom-in" data-aos-delay="500">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="register">
                        <h3>Please register to start your career journey with us!</h3>
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('auth.register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">Your First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                           id="first_name" name="first_name" value="{{ old('first_name') }}"
                                           placeholder="Enter your First Name here" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Your Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                           id="last_name" name="last_name" value="{{ old('last_name') }}"
                                           placeholder="Enter your Last Name here" required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Your Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}"
                                           placeholder="Enter Your Email here" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="phone" class="form-label">Your Phone Number</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}"
                                           placeholder="Enter Phone Number here" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" placeholder="Enter Password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirm Password" required>
                                </div>

                                <div class="col-12">
                                    <button  class="btn btn-dark">Register</button>
                                    <button type="reset" class="btn btn-light">Reset</button>
                                </div>
                            </div>
                        </form>
                        <div class="register-opt mt-4">
                            <h6>Already have an account? <a href="{{ route('pages.login') }}">Login here</a></h6>
                        </div>
                        <div class="register-opt2">
                            <h4>Alternatively you can also register With</h4>
                            <ul>
                                <li>
                                    <a href="#"><img src="images/social-icon1.png"><span>Google</span></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/social-icon2.png"><span>Apple</span></a>
                                </li>
                                <li>
                                    <a href="#"><img src="images/social-icon3.png"><span>Linkedin</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
