@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <h1 class="job-title">
                {{ $job->headline }}
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-12 col-md-6 job-details">
                    <ul class="no-style">
                        <li class="row">
                            <div class="col-xs-6">
                                <strong>Published:</strong>
                            </div>
                            <div class="col-xs-6">
                                {{ $job->jobBeginDate->format('d-m-Y H:i:s') }}
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-xs-6">
                                <strong>Deadline:</strong>
                            </div>
                            <div class="col-xs-6">
                                {{ $job->applicationdeadline->format('d-m-Y H:i:s') }}
                            </div>
                        </li>

                        @if($job->duration != '' && $job->duration !== null)
                            <li class="row">
                                <div class="col-xs-6">
                                    <strong>Duration:</strong>
                                </div>
                                <div class="col-xs-6">
                                    {{ $job->duration }}
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col-xs-12 col-md-6 job-details">
                    <ul class="no-style">
                        <li class="row">
                            <div class="col-xs-6">
                                <strong>Country:</strong>
                            </div>
                            <div class="col-xs-6">
                                {{ $job->country }}
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-xs-6">
                                <strong>Type:</strong>
                            </div>
                            <div class="col-xs-6">
                                {{ $job->advertisingType }}
                            </div>
                        </li>
                        <li class="row">
                            <div class="col-xs-6">
                                <strong>Email:</strong>
                            </div>
                            <div class="col-xs-6">
                                {{ $job->searchEmail }}
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12">
                    <hr class="epico-border-bottom" />
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <div class="text-justify job-pretty-description">
                {!! $job->prettyDescription() !!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2">
            <hr class="epico-separator" />
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 job-pretty-footer">
            {!! $job->prettyFooter() !!}
        </div>
    </div>

@endsection
