@extends('layouts.layout')

@section('content')
    <section class="sign-up" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="journey">
                            <h1>Your journey to a fulfilling career starts here.</h1>
                            <img src="images/sun-img1.png" class="img-fluid">
                        </div>
                    </div> -->
                <div class="col-md-6 offset-md-3">
                    <div class="register forgot-pswd-form">
                        <h3>Forgot password?</h3>
                        <p>Please enter your email or phone number, we will send you link to reset your password on your
                            email and via text SMS</p>
                        <form>
                            <div class="row">

                                <div class="col-md-12">
                                    <label for="your-email" class="form-label">Your Email / Phone Number</label>
                                    <input type="email" class="form-control" placeholder="Enter Your Email here"
                                        id="your-email" name="your-email" required>
                                </div>


                                <div class="col-12">
                                    <a href="" class="btn btn-dark">Send me reset password instructions</a>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
