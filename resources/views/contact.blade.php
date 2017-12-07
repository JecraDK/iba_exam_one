@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-xs-12 ">
                <h1 class="main-title">Our Locations</h1>
            </div>
        </div>
        <div class="row location-row">
            @foreach($locations as $location)

                <div class="col-md-4">
                    <div class="location-item">
                        <ul class="no-style">
                            <li><strong>{!! $location['@id'] !!}</strong> <hr class="location-line" /></li>
                            <li>{!! $location['@address'] !!}</li>
                            <li>{!! $location['@zipcode'] !!}</li>
                            <li>{!! $location['@city'] !!}</li>
                            <li>{!! $location['@country'] !!}</li>
                            <li>&nbsp;</li>
                            <li><a href="tel:{!! str_replace(' ','',$location['@phone'] ) !!}">{!! $location['@phone'] !!}</a></li>
                            <li><a href="mailto:{!! $location['@fax'] !!}">{!! $location['@fax'] !!}</a></li>
                        </ul>
                    </div>

                </div>

                @if($loop->iteration % 3 == 0)
                    </div><div class="row location-row">
                @endif

            @endforeach
        </div>

        <div class="row">
            <div class="col-xs-12">
                <h2 class="main-title">Contacts</h2>
            </div>
        </div>
        <div class="row contact-list-row">
            @foreach($contactList as $contacts)
                <div class="col-xs-12 col-md-4">
                    <div class="row">
                        <div class="col-xs-12">
                            <img src="{!! $contacts['@image'] !!}" class="img-responsive classy-image" />
                        </div>
                        <div class="col-xs-12">
                            <hr />
                        </div>
                        <div class="col-xs-12">
                            <ul class="no-style contact-details">
                                <li><strong>Navn:</strong> {!! $contacts['@name'] !!}</li>
                                <li><strong>Telefon:</strong> <a href="tel:{!! str_replace(' ','',$contacts['@phone']) !!}">{!! $contacts['@phone'] !!}</a></li>
                                <li><strong>Email:</strong> <a href="mailto:{!! $contacts['@email'] !!}">{!! $contacts['@email'] !!}</a></li>
                                <li><strong>Afdeling:</strong> {!! $contacts['@department'] !!}</li>
                                <li><strong>Placering:</strong> {!! $contacts['@location'] !!}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12"><br/></div>
                    </div>
                </div>

                @if($loop->iteration % 3 == 0)
                    </div><div class="row contact-list-row">
                @endif
            @endforeach
        </div>


    </div>
@endsection
