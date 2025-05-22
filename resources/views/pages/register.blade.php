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
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="your-name" class="form-label">Your First Name</label>
                                    <input type="text" class="form-control" id="your-name" name="your-name"
                                        placeholder="Enter your First Name here" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="your-surname" class="form-label">Your Last Name</label>
                                    <input type="text" class="form-control" id="your-surname" name="your-surname"
                                        placeholder="Enter your Last Name here" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="your-email" class="form-label">Your Email</label>
                                    <input type="email" class="form-control" id="your-email" name="your-email"
                                        placeholder="Enter Your Email here" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="your-subject" class="form-label">Your Phone Number</label>
                                    <input type="text" class="form-control" id="your-subject"
                                        placeholder="Enter Phone Number here" name="your-subject" required>
                                </div>

                                <div class="col-12">
                                    <a href="payment.html" class="btn btn-dark">Join Now</a>
                                    <button type="submit" class="btn btn-light">Reset</button>
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
