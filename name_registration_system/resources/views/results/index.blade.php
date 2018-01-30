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
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/results-style.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
		<header>
        	<div class="row">

        		<div class="col-sm-1 col-xs-2">
        			<img id="logo" src="http://www.decipherstudios.com/wp-content/uploads/your-logo-here.png" alt="Logo" height="48px" />
        		</div>

        		<div class="col-sm-11 col-xs-10">
        			<div class="row">
        				<div class="col-md-6 col-sm-8 col-xs-10">
							{!! Form::open(['action' => ['ResultsController@searchDomain'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => '' ]) !!}
                    			{!! Form::token() !!}
								<div class="input-group">
									<input type="text" name="search" class="form-control" placeholder="Search" value="{{ session('results')['keyword'] }}" />
									<div class="input-group-btn">
										<button class="btn btn-success" type="submit">
											<i class="fa fa-search" aria-hidden="true"></i>
										</button>
									</div>
								</div>
							{!! Form::close() !!}
        				</div>

        				<div class="col-md-6 col-sm-4 col-xs-2 text-right">
        					<a href="javascript:void(0)" class="btn menu-btn">
        						<i class="fa fa-bars" aria-hidden="true"></i>
        					</a>
        				</div>
        			</div>

        		</div>

        	</div>
    	</header>

    	<section>
    		<div class="row">
    			<div class="col-sm-offset-1 col-xs-offset-1 col-sm-11">


					<div class="row">
						<div class="col-md-6 col-sm-8 col-xs-10">

							@if ( session()->has('results') )
								@if( ! empty( session('results') ) && ! empty( session( 'results' )['keyword'] ) )
									<?php
										$keyword = session( 'results' )['keyword'];
										$expected = session( 'results' )['expected'];
										$notice = '';
										$class = '';
									?>
									<!--
										$expected->status = 0 => Expired
										$expected->status = 1 => Actived
									-->
									@if( empty( $expected ) || ( ! empty( $expected ) && $expected->status == 0 ) )
										<?php
											$notice = 'Yes! &quot;'. $keyword .'&quot; is available. Register it before someone else does.';
										?>
									@else
										<?php
											$notice = 'Sorry, &quot;'. $expected->name .'&quot; is taken';
											$class = 'not-available';
										?>
									@endif
									<!-- Result items -->
									<div class="result-item">
										<h4 class="notice">{{ $notice }}</h4>
										<div class="domain-box {{ $class }}">
											<div class="table-div">
												<div class="table-cell-div">
													<h3>
														<a href="javascript:void(0)">{{ empty($expected) ? $keyword : $expected->name }}</a>
													</h3>
												</div>

												<div class="table-cell-div text-right">
													@if( empty( $expected ) || ( ! empty( $expected ) && $expected->status == 0 ) )
														{!! Form::open(['action' => 'ResultsController@registerDomain', 'method' => 'POST']) !!}
															{!! Form::token() !!}
															{!! Form::hidden('name', $keyword) !!}
															<button class="btn btn-success">
																Register for Free
															</button>
														{!! Form::close() !!}
													@endif
												</div>
											</div>
										</div>
									</div>
								@endif

								@if( ! empty( session('results')['similars'] ) )
									<?php
										$similars = session('results')['similars'];
									?>
									@foreach ( $similars as $similar )
										<!-- Result items similar -->
										<div class="result-item">
											<h3>
												<a href="javascript:void(0)">{{ $similar->name }}</a>
											</h3>
											<p class="description">
												{{ $similar->description }}
											</p>
											@if ( ! empty( $similar->user_id ) )
												<p class="regis_by">
													<!-- <span class="user-avatar">
														<img src="https://medizzy.com/_nuxt/img/user-placeholder.d2a3ff8.png" width="15px" height="15px" alt="user1" />
													</span> -->
													Registered by <strong class="text-uppercase">{{ DB::table('users')->where('id', $similar->user_id)->first()->name }}:</strong> {{ $similar->register_date }}
												</p>
											@endif
										</div>
									@endforeach
								@endif
							@endif

						</div>
					</div>

    			</div>
    		</div>
    	</section>
    </body>

</html>
