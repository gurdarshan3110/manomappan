@extends('layouts.layout')

@section('content')


<section class="career-guide aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: '&gt;';" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('pages.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Career Guide</a></li>
                        @if($career->cluster)
                            <li class="breadcrumb-item"><a href="{{ route('pages.cluster', $career->cluster->slug) }}">{{ $career->cluster->name }}</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{ $career->title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2>{{ $career->title }}</h2>
                    <p class="m-0">
                        {{ $career->seo_description ?? 'Explore this exciting career path and discover the opportunities, challenges, and requirements that come with it. Learn about the skills needed, career prospects, and how to get started in this field.' }}
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="right-img">
                        <img src="{{ $career->thumbnail_url ?? 'images/blank-img2.png' }}" class="img-fluid" alt="{{ $career->thumbnail_alt ?? $career->title }}">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="career-engineer aos-init aos-animate" data-aos="fade-down" data-aos-delay="200">
        <div class="container">
            <h5>Table of content</h5>
            <div class="row">
                <div class="col-lg-3">
                    <div class="career-summary-lt">
                        <form>
                            <ul class="nav flex-column nav-pills" id="career-tab" role="tablist">
                                @if(!empty($sections))
                                    @php $tabIndex = 1; @endphp
                                    @foreach($sections as $section)
                                        <li>
                                            <a href="#">
                                                <input type="radio" id="table{{ $tabIndex }}" name="radio-group" {{ $tabIndex === 1 ? 'checked=""' : '' }} hidden="">
                                                <label for="table{{ $tabIndex }}" class="nav-link {{ $tabIndex === 1 ? 'active' : '' }}" id="tab{{ $tabIndex }}-tab" data-bs-toggle="pill" data-bs-target="#tab{{ $tabIndex }}" role="tab" aria-controls="tab{{ $tabIndex }}" aria-selected="{{ $tabIndex === 1 ? 'true' : 'false' }}">
                                                    {{ $section['title'] }} <img src="{{ asset('images/thumb-img.png')}}" alt="">
                                                </label>
                                            </a>
                                        </li>
                                        @php $tabIndex++; @endphp
                                    @endforeach
                                @else
                                    <li>
                                        <a href="#">
                                            <input type="radio" id="table1" name="radio-group" checked="" hidden="">
                                            <label for="table1" class="nav-link active" id="tab1-tab" data-bs-toggle="pill" data-bs-target="#tab1" role="tab" aria-controls="tab1" aria-selected="true">
                                                Career Information <img src="{{ asset('images/thumb-img.png')}}" alt="">
                                            </label>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </form>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="career-summary-rt tab-content" id="career-tabContent">
                        @if(!empty($sections))
                            @php $tabIndex = 1; @endphp
                            @foreach($sections as $section)
                                <div class="tab-pane fade {{ $tabIndex === 1 ? 'active show' : '' }}" id="tab{{ $tabIndex }}" role="tabpanel" aria-labelledby="tab{{ $tabIndex }}-tab">
                                    @include('pages.career-sections.' . strtolower($section['type']), ['section' => $section])
                                </div>
                                @php $tabIndex++; @endphp
                            @endforeach
                        @else
                            <div class="tab-pane fade active show">
                                <div class="career-summary-rt">
                                    <h3>Career Information</h3>
                                    <div class="section-box">
                                        <p>This career doesn't have detailed sections configured yet. Please check back later for more information.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
                               