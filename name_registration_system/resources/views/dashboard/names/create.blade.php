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
                    <h3 class="box-title">{{trans('domains.register_name')}}</h3>
                </div>

                <div class="box-body">
                    {!! Form::open(['action' => ['Dashboard\NameManagementController@store'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                    {!! Form::token() !!}
                    <div class="box-body">
                        <div class="form-group required">
                            {!! Form::label('name', trans('domains.domain_name'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('name', $name, ['class' => 'form-control', 'required', 'readonly']) !!}
                            </div>
                        </div>
                        <div class="form-group required">
                            {!! Form::label('description', trans('domains.description'), ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-8">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'required', 'rows' => 4]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{action('Dashboard\NameManagementController@index')}}" class="btn btn-default">{{ trans('forms.cancel') }}</a>
                        <button type="submit" class="btn btn-info pull-right">{{ trans('forms.submit') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop