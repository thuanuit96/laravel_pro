<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="flex-center position-ref full-height">

            @if (Route::has('auth'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Home</a>
                    @else
                        <a href="{{ route('auth') }}">Login</a>
                        <a href="{{ route('auth') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content full-height">
                {{--<form action="" method="" class="">--}}
                    {!! Form::open(['action' => ['DomainController@searchDomain'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal center-div' ]) !!}
                    {!! Form::token() !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <img alt="Empty" src="https://99designs-blog.imgix.net/blog/wp-content/uploads/2016/07/logo-2.png?auto=format&q=60&fit=max&w=930" width="272" />
                        <br/><br/>

                        <div class="form-group">
                            <input class="form-control" type="text" name="search" id="searchDomain" placeholder="" value="" required />
                        </div>

                        <div class="form-group">
                            <button id="btnSearchDomain" type="submit" class="btn btn-default">
                                Search
                            </button>
                            @include('layouts.notice_messages')
                        </div>
                    {!! Form::close() !!}

                {{--</form>--}}

            </div>


        </div>
    </body>

</html>
