<section class="our-plan" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-md-1">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Our Plans</h3>
                    <p>Our plans are designed to fit your needs, offering as much support as you require. Need more? You can upgrade anytime.</p>
                 </div>
                 <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th valign="middle" style="background:#F7F7F7;"><h4>Plan</h4></th>
                        @foreach($packages as $package)
                        <th class="table-heading" valign="top">
                            <table width="100%" valign="top">
                              <tr>
                                <td class="p-0"><h3>{{ $package->plan_name }}</h3></td>
                                <td class="p-0 text-end" width="50%">
                                    <img src="images/compass3.png" alt="{{ $package->plan_name }}">
                                </td>
                              </tr>
                            </table>
                        </th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Price</td>
                        @foreach($packages as $package)
                        <td class="price-text">₹ {{ number_format($package->price) }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td class="p-0" valign="middle">Buy Plan</td>
                        @foreach($packages as $package)
                        <td class="p-0 bg-transparent">
                            <a href="{{ route('pages.buy_package', $package->id) }}" class="btn btn-{{ $loop->first ? 'light' : 'dark' }} w-100">Buy Now</a>
                        </td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Counsellor</td>
                        @foreach($packages as $package)
                        <td>{{ $package->counsellor }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Language</td>
                        @foreach($packages as $package)
                        <td>{{ $package->language }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Report</td>
                        @foreach($packages as $package)
                        <td>{{ $package->report }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>AI drive career support</td>
                        @foreach($packages as $package)
                        <td>{{ $package->ai_drive_career_support }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Career counselling session</td>
                        @foreach($packages as $package)
                        <td>{{ $package->career_counselling_session }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Sessions with Role Model and Parents</td>
                        @foreach($packages as $package)
                        <td>{{ $package->sessions_with_role_model_and_parents }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Certified expert guidence</td>
                        @foreach($packages as $package)
                        <td>{{ $package->certified_expert_guidence }}</td>
                        @endforeach
                      </tr>
                      <tr>
                        <td>Included Tests</td>
                        @foreach($packages as $package)
                        <td>
                            @if($package->tests->count() > 0)
                                <ul class="test-list">
                                    @foreach($package->tests as $test)
                                        <li>{{ $test->display_name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No Tests</span>
                            @endif
                        </td>
                        @endforeach
                      </tr>
                      <tr>
                        <td class="p-0 bg-transparent"></td>
                        @foreach($packages as $package)
                        <td class="p-0 bg-transparent">
                            <a href="{{ route('pages.buy_package', $package->id) }}" class="btn btn-{{ $loop->first ? 'light' : 'dark' }} w-100">Buy Now</a>
                        </td>
                        @endforeach
                      </tr>
                    </tbody>
                  </table>
            </div>           
          </div>
        </div>
    </div>
</section> 

<section class="our-plan our-plan-mob" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <h3>Our Plans</h3>
        <p>Our plans are designed to fit your needs, offering as much support as you require. Need more? You can upgrade anytime.</p>
        <div class="row">
          @foreach($packages as $package)
          <div class="col-12">
            <div class="career-compass-card">
              <div class="d-flex justify-content-between align-items-center">
                <h4>{{ $package->plan_name }}</h4>
                <img src="images/compass3.png" alt="{{ $package->plan_name }}">
              </div>
              <p>{{ $package->description }}</p>
              
              @if($package->tests->count() > 0)
                <div class="included-tests mb-3">
                  <h6 class="mb-2">Included Tests:</h6>
                  <ul class="test-list-mobile">
                    @foreach($package->tests as $test)
                      <li>{{ $test->display_name }}</li>
                    @endforeach
                  </ul>
                </div>
              @else
                <div class="included-tests mb-3">
                  <h6 class="mb-2">Included Tests:</h6>
                  <span class="text-muted">No Tests</span>
                </div>
              @endif
              
              <div class="career-compass-price">
                <h4>₹ {{ number_format($package->price) }}</h4>
                <a href="{{ route('pages.buy_package', $package->id) }}" class="btn btn-dark w-100">Buy Now</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>  
</section>
