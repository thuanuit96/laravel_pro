@extends('adminlte::page')

@section('title', 'Domain Name')

@section('content_header')
@stop

@section('css')
    <link href="{{ asset('css/my-domain.css') }}" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('domains.list_domain')}}</h3>

                        {!! Form::open(['action' => ['DomainController@redirectNameManagement'], 'method' => 'POST', 'class' => 'search-form' ]) !!}
                        {!! Form::token() !!}

                            <input type="text" class="input-search-form" name="search" placeholder="Search" value="{{ session('results')['keyword'] }}"/>
                            <div class="input-group-btn">
                                <button class="btn btn-success button-search" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>

                        {!! Form::close() !!}

                </div >
                @include('layouts.notice_messages')
                <div class="box-body">
                    <table class="table">
                       <thead>
                         <tr>
                           <th>{{ trans('domains.domain_name') }}</th>
                           <th>{{ trans('domains.expired_at') }}</th>
                           <th>{{ trans('domains.action') }}</th>
                         </tr>
                       </thead>
                       <tbody>
                       @foreach($domains as $domain)
                         <tr>
                           <td>{{$domain->name}}</td>
                           <td>{{$domain->expiration_date}}</td>
                           <td>
                               <a href="{{route('domains.edit', $domain->id)}}"><input value="Edit" type="button" class="btn btn-primary"></a>
                               @if ($domain->canRenew())
                                <a href="{{route('domains.renew', $domain->id)}}" class="btn btn-info">Renew</a>
                               @endif
                               {!! Form::open(['action' => ['DomainController@destroy', $domain->id],
                                                            'method' => 'DELETE',
                                                            'onsubmit' => 'return confirmForm(this);',
                                                            'data-confirm-message' => trans('labels.confirm_delete'),
                                                            'class' => 'inline',
                                                            ]) !!}
                               <?php $disabled = (Auth::user()->id == $domain->user_id)? '':'disabled'; ?>
                               {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', [$disabled , 'type' => 'submit', 'class' => 'btn btn-danger', 'onClick' => 'return window.confirm("Are you sure?")']) }}
                               {!! Form::close() !!}
                           </td>
                         </tr>
                       @endforeach

                       </tbody>
                     </table>
                </div>
            </div>
        </div>
    </div>
@stop