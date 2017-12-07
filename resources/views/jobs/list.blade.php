@extends('layouts.app')

@section('content')
    <div class="row section-header">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <h1>
                Vacancies
            </h1>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dictum ante mi, ut ornare eros fermentum suscipit.
                Maecenas interdum arcu sit amet mauris pellentesque imperdiet.
                Mauris sodales eget mi pulvinar condimentum.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            @foreach($jobs as $type => $vacancies)

                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="vacancy-title">{{ $type }}</h2>
                    </div>
                </div>

                @foreach($vacancies as $job)
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>{{ $job->headline }}</h3>
                        </div>
                        <div class="col-xs-12">
                            {!! str_limit($job->description,80,'&hellip;') !!}
                        </div>
                    </div>
                    <div class="row job-list-details">
                        <div class="col-xs-12 col-md-9">
                            <strong>Published:</strong> {{ $job->jobBeginDate->format('d-m-Y H:i:s') }} |
                            <strong>Deadline:</strong> {{ $job->applicationdeadline->format('d-m-Y H:i:s') }} |
                           @if($job->duration != '' && $job->duration !== null) <strong>Duration:</strong> {{ $job->duration }} @endif
                        </div>
                        <div class="col-xs-12 col-md-3 job-read-more-link">
                            <a href="{{ route('jobAd',['job' => $job->id]) }}">Read more</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <hr />
                        </div>
                    </div>
                @endforeach

            @endforeach
        </div>
    </div>
@endsection
