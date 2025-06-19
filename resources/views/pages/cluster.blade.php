@extends('layouts.layout')

@section('content')
<section class="cluster-details" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('pages.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $cluster->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-lg-8">
                <h1 class="mb-4">{{ $cluster->name }}</h1>
                @if($cluster->description)
                    <div class="cluster-description">
                        {!! $cluster->description !!}
                    </div>
                @endif
            </div>
            @if($cluster->thumbnail)
                <div class="col-lg-4">
                    <img src="{{ Storage::url($cluster->thumbnail) }}" 
                         alt="{{ $cluster->thumbnail_alt }}" 
                         class="img-fluid rounded">
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Careers in {{ $cluster->name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Career Title</th>
                                        <th>Summary</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($careers as $career)
                                        <tr>
                                            <td>
                                                <strong>{{ $career->title }}</strong>
                                            </td>
                                            <td>
                                                @if($career->sections->first())
                                                    {{ Str::limit(strip_tags($career->sections->first()->section_content), 100) }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('pages.career', ['cluster' => $cluster->slug, 'career' => $career->slug]) }}" 
                                                   class="btn btn-sm btn-dark p-2">
                                                    View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No careers found in this cluster.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

