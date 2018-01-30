@extends('adminlte::page')

@section('title', 'Domain Name')

@section('content_header')
    {{--<h1>Create domain</h1>--}}
@stop

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box  box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans('domains.create_domain')}}</h3>
                </div>

                <div class="box-body">
                    {!! Form::open(['action' => ['DomainController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) !!}
                    {!! Form::token() !!}
                    <div class="box-body">
                        <div class="form-group required">
                            {!! Form::label('name', trans('domains.domain_name'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="{{action('DomainController@index')}}" class="btn btn-default">{{ trans('forms.cancel') }}</a>
                        <button type="submit" class="btn btn-info pull-right">{{ trans('forms.submit') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop