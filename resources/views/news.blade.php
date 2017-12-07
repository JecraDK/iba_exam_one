@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>News</h1>
            </div>
        </div>
            @foreach($news as $newsitem)
            <div class="row news-item-row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2>{!! $newsitem['title'] !!}</h2>
                            <hr class="epico-separator" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            {!! $newsitem['postdisplaydate']->format('d-m-Y H:i:s') !!} / {!! $newsitem['authorname'] !!}
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            {!! $newsitem['category'] !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <hr />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-8">
                            {!! $newsitem['description'] !!}
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <img src="{!! $newsitem['primaryimageurl'] !!}" class="img-responsive" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-7 news-tags">
                            @if(isset($newsitem['tags']))<strong>Tags:</strong> {!! $newsitem['tags'] !!}@endif
                        </div>
                        <div class="col-xs-12 col-md-5 tags-and-link text-right">
                            <a href="{!! $newsitem['blogposturl'] !!}" target="_blank">Link to article</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
@endsection
