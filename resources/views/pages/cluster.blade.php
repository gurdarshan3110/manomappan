@extends('layouts.layout')

@section('content')
    <section class="career-guide aos-init aos-animate" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <nav style="--bs-breadcrumb-divider: '&gt;';" aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('pages.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#">Career Guide</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $cluster->name }}</a></li>
                        </a>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $cluster->name }}</h2>
                    <div>
                        {!! $cluster->description !!}
                    </div>
                </div>
                @if ($cluster->thumbnail)
                    <div class="col-lg-4">
                        <img src="{{ Storage::url($cluster->thumbnail) }}" alt="{{ $cluster->thumbnail_alt }}"
                            class="img-fluid rounded">
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="career-engineer aos-init aos-animate" data-aos="fade-down" data-aos-delay="200">
        <div class="container">
            <h5>Careers in {{ $cluster->name }}</h5>
            <div class="row justify-content-center career-cluster-img">
                @forelse($careers as $career)
                    <div class="col-md-3">
                        <a href="{{ route('pages.career', ['cluster' => $cluster->slug, 'career' => $career->slug]) }}">
                            <img src="{{ $career->thumbnail_url }}" alt="{{ $career->title }}" class="img-fluid">
                            <span>{{ $career->title }}</span>
                        </a>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p>No careers found in this cluster.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
