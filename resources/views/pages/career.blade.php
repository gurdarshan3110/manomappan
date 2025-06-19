@extends('layouts.layout')

@section('content')
<section class="career-details" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('pages.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pages.cluster', $career->cluster->slug) }}">{{ $career->cluster->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $career->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ $career->title }}</h1>
            </div>
            @if($career->thumbnail)
                <div class="col-lg-4">
                    <img src="{{ Storage::url($career->thumbnail) }}" 
                         alt="{{ $career->thumbnail_alt }}" 
                         class="img-fluid rounded">
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12">
                @foreach($career->sections->sortBy('section_order') as $section)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3>{{ $section->section_title }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if($section->section_image)
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($section->section_image) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $section->section_title }}">
                                    </div>
                                @endif
                                <div class="{{ $section->section_image ? 'col-md-8' : 'col-md-12' }}">
                                    {!! $section->section_content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($career->relatedCareers->count() > 0)
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Related Careers</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Career Title</th>
                                            <th>Cluster</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($career->relatedCareers as $relatedCareer)
                                            <tr>
                                                <td>
                                                    <strong>{{ $relatedCareer->title }}</strong>
                                                </td>
                                                <td>{{ $relatedCareer->cluster->name }}</td>
                                                <td>
                                                    <a href="{{ route('pages.career', ['cluster' => $relatedCareer->cluster->slug, 'career' => $relatedCareer->slug]) }}" 
                                                       class="btn btn-sm btn-dark">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
