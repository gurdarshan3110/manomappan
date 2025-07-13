@extends('layouts.layout')

@section('content')
   <section class="welcome aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
      <div class="container">
        <div class="welcome-inner">
          <h3>Welcome {{$user->name}}</h3>
          <div class="row">
            <div class="col-md-9">
              <p><b>It is your career journey, do it right!</b> You have taken an important step towards finding a perfect career for you. Now please complete your profile so we can get to know you better and guide you accordingly.</p>
            </div>
            <div class="col-md-3 justify-content-end d-flex">
              <a href="#" class="btn btn-dark">Book Career  Session Now!</a>
            </div>   
          </div>
        </div> 
      </div>      
    </section>
    <section class="prsnl-career aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="prsnl-career-left">
              <h5>Your Personal Career Calibrators</h5>
              <p>Discover your strengths and passions with our Career Calibrator—your compass to a fulfilling career.</p>
              <div class="career-calibration">
                <p><b>Your Career Calibration</b></p>
                <div class="career-calibration-progress">
                  <div class="progress-box"></div>
                  <div class="progress-box"></div>
                  <div class="progress-box"></div>
                </div>
                <p>0 of 3 Completed</p>
              </div>
              <div class="aptitude">
                <div class="row align-items-center">
                  <div class="col-md-7">
                    <div class="aptitude-left">
                      <img src="images/aptitude1.png">
                      <div class="aptitude-text">
                        <h5>Aptitude</h5>
                        <p>with this assessment you can identify your natural aptitude in certain areas.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5"> 
                    <div class="start-now">
                      <span><img src="images/timer.png">1:00 Hour</span>
                      <a href="#" class="btn btn-light mt-0">Start Now</a>
                    </div>
                  </div>  
                </div>

              </div>

              <div class="aptitude">
                <div class="row align-items-center">
                  <div class="col-md-7">
                    <div class="aptitude-left">
                      <img src="images/aptitude2.png">
                      <div class="aptitude-text">
                        <h5>Personality</h5>
                        <p>with this assessment you can identify your natural aptitude in certain areas.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5"> 
                    <div class="start-now">
                      <span><img src="images/timer.png">1:00 Hour</span>
                      <a href="#" class="btn btn-light mt-0">Start Now</a>
                    </div>
                  </div>  
                </div>
              </div>

              <div class="aptitude">
                <div class="row align-items-center">
                  <div class="col-md-7">
                    <div class="aptitude-left">
                      <img src="images/aptitude3.png">
                      <div class="aptitude-text">
                        <h5>Interest</h5>
                        <p>with this assessment you can identify your natural aptitude in certain areas.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5"> 
                    <div class="start-now">
                      <span><img src="images/timer.png">1:00 Hour</span>
                      <a href="#" class="btn btn-light mt-0">Start Now</a>
                    </div>
                  </div>  
                </div>
              </div>
            </div>  
          </div>  
          <div class="col-md-4">
            <div class="prsnl-career-left">
              <h5>Book career guidance session</h5>
              <p>Cost should not be hurdle to receive career guidance, hence we have made your first session free of cost.</p>
              <a href="#" class="btn btn-light">Book Career Session</a>
            </div>
            <h5 class="session-heading">Your upcoming sessions</h5>
            <div class="coming-sessions">
              <p>
                You don’t have a session scheduled—take the next step toward clarity and success today!
              </p>
              <a href="#" class="btn btn-dark w-100">Book Career Session Now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
