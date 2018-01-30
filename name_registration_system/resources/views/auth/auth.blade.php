<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        @section('adminlte_css')
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
            <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
            @yield('css')
        @stop
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content full-height">
                <div class="row" style="margin: 228px auto 0px; max-width: 1024px;">
                    @extends('adminlte::master')

                    <div class="col-sm-7">
                        <h1>Welcome to Site</h1>
                        <h3>
                            Connect with your friends - and other fascinating people. Get in-the-moment Updates on the things that interest you. And watch events unfold, in real time, from every angle.
                        </h3>
                        @if(isset($domainName))
                            <div class="alert alert-dismissible alert-success">
                                <p style="font-size: large">You have chosen domain: <span>{{ $domainName }}</span></p>
                                  <a href="{{ action('ResultsController@ChangeDomain') }}" class="">Change your domain?</a>
                            </div>

                        @endif
                    </div>

                    <div class="col-sm-5">

                        <div class="login-box">
                            <!-- /.login-logo -->
                            <div class="login-box-body">
                                <!-- <p class="login-box-msg">{{ trans('adminlte::adminlte.login_message') }}</p> -->
                                <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                                    {!! csrf_field() !!}
                                    @if(isset($domainName))
                                        <input type="hidden" name="domainName" value="{{ $domainName }}">
                                    @endif

                                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                               placeholder="{{ trans('adminlte::adminlte.email') }}">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8" style="padding-right: 2.5px;">
                                            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                                <input type="password" name="password" class="form-control"
                                                       placeholder="{{ trans('adminlte::adminlte.password') }}">
                                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-xs-4" style="padding-left: 2.5px;">
                                            <button type="submit"
                                                    class="btn btn-primary btn-block btn-flat">
                                                    {{ trans('adminlte::adminlte.sign_in') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="checkbox icheck" style="display: inline-block;">
                                        <label>
                                            <input type="checkbox" name="remember"> {{ trans('adminlte::adminlte.remember_me') }}
                                        </label>
                                    </div>
                                    &nbsp;<strong>.</strong>&nbsp;
                                    <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="text-center">{{ trans('adminlte::adminlte.i_forgot_my_password') }}</a>
                                </form>
                            </div>
                            <!-- /.login-box-body -->
                        </div><!-- /.login-box -->

                        <br/>

                        <div class="register-box">
                            <div class="register-box-body">
                                <!-- <p class="login-box-msg">{{ trans('adminlte::adminlte.register_message') }}</p> -->
                                <h3 style="margin: 0px -20px 20px; border-bottom: 1px solid #e6ecf0; padding: 0px 0px 20px 20px;">
                                    <strong style="color: #000000;">New to Site? <span style="color: #66757F;">Sign Up</span></strong>
                                </h3>
                                <form action="{{ url(config('adminlte.register_url', 'register')) }}" method="post">
                                    {!! csrf_field() !!}

                                    @if(isset($domainName))
                                        <input type="hidden" name="domainName" value="{{ $domainName }}">
                                    @endif
                                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                               placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                               placeholder="{{ trans('adminlte::adminlte.email') }}">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <input type="password" name="password" class="form-control"
                                               placeholder="{{ trans('adminlte::adminlte.password') }}">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                        <input type="password" name="password_confirmation" class="form-control"
                                               placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                                        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <button type="submit"
                                            class="btn btn-primary btn-flat">{{ trans('adminlte::adminlte.register') }}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.form-box -->
                        </div><!-- /.register-box -->

                        @section('adminlte_js')
                            <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
                            <script>
                                $(function () {
                                    $('input').iCheck({
                                        checkboxClass: 'icheckbox_square-blue',
                                        radioClass: 'iradio_square-blue',
                                        increaseArea: '20%' // optional
                                    });
                                });
                            </script>
                            @yield('js')
                        @stop

                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
