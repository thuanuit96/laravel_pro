
<!DOCTYPE html>
<!--[if IEMobile 7 ]> <html lang="en_US" class="no-js iem7"> <![endif]-->
<!--[if lt IE 7]> <html class="ie6 lt-ie10 lt-ie9 lt-ie8 lt-ie7 no-js" lang="en_US"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 lt-ie10 lt-ie9 lt-ie8 no-js" lang="en_US"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 lt-ie10 lt-ie9 no-js" lang="en_US"> <![endif]-->
<!--[if IE 9]>    <html class="ie9 lt-ie10 no-js" lang="en_US"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html class="no-js" lang="en_US"><!--<![endif]-->

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta http-equiv="content-type" content="text/html; charset=UTF-8;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=1" />
	<meta name="HandheldFriendly" content="true"/>

	<link rel="canonical" href="https://duckduckgo.com/">

	<link rel="stylesheet" href="{{asset('css/s1522.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('css/t1522.css')}}" type="text/css">


	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" sizes="16x16 24x24 32x32 64x64"/>
	<link rel="apple-touch-icon" href="/assets/icons/meta/DDG-iOS-icon_60x60.png"/>
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/icons/meta/DDG-iOS-icon_76x76.png"/>
	<link rel="apple-touch-icon" sizes="120x120" href="/assets/icons/meta/DDG-iOS-icon_120x120.png"/>
	<link rel="apple-touch-icon" sizes="152x152" href="/assets/icons/meta/DDG-iOS-icon_152x152.png"/>
	<link rel="image_src" href="/assets/icons/meta/DDG-icon_256x256.png"/>
	<link rel="manifest" href="/manifest.json"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" value="@duckduckgo">

	<meta property="og:url" content="https://duckduckgo.com/" />
	<meta property="og:site_name" content="DuckDuckGo" />
	<meta property="og:image" content="https://duckduckgo.com/assets/logo_social-media.png">


	<title>Laravel</title>
	<meta property="og:title" content="DuckDuckGo" />


	<meta property="og:description" content="DuckDuckGo is the search engine that doesn't track you. We protect your search history from everyone – even us!">
	<meta name="description" content="DuckDuckGo is the search engine that doesn't track you. We protect your search history from everyone – even us!">
</head>
<body id="pg-index" class="page-index body--home">
	<script type="text/javascript">
		var settings_js_version = "/s2320.js",
		locale = "en_US";
	</script>
	<script type="text/javascript" src="{{asset('js/duckduckgo-duckduckgo+sprintf+gettext+locale-simple.20180115.093003.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/l109.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/u165.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/d2320.js')}}"></script>
	{{--<script type="text/javascript">--}}
		{{--DDG.page = new DDG.Pages.Home();--}}
	{{--</script>--}}
	<style type="text/css">
	.search__button:hover{background-color:#5b9e4d;color:#fff}
</style>

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
	<div class="site-wrapper  site-wrapper--home  js-site-wrapper">
		
		
		<div class="header-wrap--home  js-header-wrap"></div>

		<div id="" class="content-wrap--home">
			<div id="content_homepage" class="content--home">
				<div class="cw--c">
					<div class="logo-wrap--home">
						<a id="logo_homepage_link" href="/about">
							<img alt="Empty" src="https://99designs-blog.imgix.net/blog/wp-content/uploads/2016/07/logo-2.png?auto=format&q=60&fit=max&w=930" width="272" />
						</a>
					</div>

					<div class="search-wrap--home">
						{!! Form::open(['action' => ['ResultsController@searchDomain'], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'search  search--home  js-search-form' ]) !!}
                    	{!! Form::token() !!}
							<input id="search" name="search"  class="search__input js-search-input" type="text" autocomplete="off" tabindex="1" value="" required/>
							<input id="search_button_homepage" class="search__button  js-search-button" type="submit" tabindex="2" value="S" />
							<div id="search_elements_hidden" class="search__hidden  js-search-hidden"></div>
						{!! Form::close() !!}

					</div>
					
					
					

					<!-- en_US All Settings -->
					<div>
						<div class="tag-home">
							<div class="tag-home__wrapper">
								<div class="tag-home__item">
									The search engine that doesn't track you.
									<span class="hide--screen-xs"><a href="/about" class="tag-home__link">Learn More</a>.</span>
								</div>
								<div>
						@include('layouts.notice_messages')
					</div>
							</div>
						</div>
					</div>
					
					<div class="tag-home  tag-home--slide  no-js__hide  js-tag-home"></div>
					<div id="error_homepage"></div>


					
					
				</div> <!-- cw -->
			</div> <!-- content_homepage //-->
		</div> <!-- content_wrapper_homepage //-->
		<div id="footer_homepage" class="foot-home  js-foot-home"></div>

		<script type="text/javascript">
			{function seterr(str) {
				var error=document.getElementById('error_homepage');
				error.innerHTML=str;
				$(error).css('display','block');
			}
			var err=new RegExp('[\?\&]e=([^\&]+)');var errm=new Array();errm['2']='no search';errm['3']='search too long';errm['4']='not UTF\u002d8 encoding';errm['6']='too many search terms';if (err.test(window.location.href)) seterr('Oops, '+(errm[RegExp.$1]?errm[RegExp.$1]:'there was an error.')+' &nbsp;Please try again');};
			
			if (kurl) {
				document.getElementById("logo_homepage_link").href += (document.getElementById("logo_homepage_link").href.indexOf('?')==-1 ? '?t=i' : '') + kurl;
			}
		</script>

		
		
		
	</div> <!-- site-wrapper -->
</body>
</html>
