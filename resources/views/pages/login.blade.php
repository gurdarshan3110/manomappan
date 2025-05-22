@extends('layouts.layout')

@section('content')
    <section class="sign-up login" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="journey">
                            <h1>Your journey to a fulfilling career starts here.</h1>
                            <img src="images/sun-img1.png" class="img-fluid">
                        </div>
                    </div> -->
                <div class="col-md-6 offset-md-3">
                    <div class="register">
                        <h3>Login into Manomaapan</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="your-name" class="form-label">Your Email / Phone Number</label>
                                    <input type="text" class="form-control" id="your-name"
                                        placeholder="Enter Your Email here" name="your-name" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="your-email" class="form-label">Your Password</label>
                                    <input type="email" class="form-control" id="your-email" name="your-email"
                                        placeholder="Enter Phone Number here" required>
                                </div>
                                <div class="col-12">
                                    <a href="payment.html" class="btn btn-dark">Login</a>
                                    <button type="submit" class="btn btn-light">Reset</button>
                                </div>
                            </div>
                        </form>
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
                        <a href="forgot-password.html" class="forgot-pswd-label">Forgot Password? Click here</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
