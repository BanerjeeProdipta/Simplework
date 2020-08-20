<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="{{ asset('css/default.css') }}" rel="stylesheet">
<link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
</head>
<body>
	<div id="header-wrapper">
		<div id="header" class="container">
			<div id="logo">
				<h2><a href="/">Simplework</a></h2>
			</div>
			<div id="menu">
				<ul>
					<li id="hvr" class="{{ Request::path() === '/' ? 'current_page_item' : '' }}"><a href="/"  accesskey="1" title="">Homepage</a></li>
					<li id="hvr" class="{{ Request::path() === 'about' ? 'current_page_item' : '' }}"><a href="/about"  accesskey="3" title="">About Us</a></li>
					<li id="hvr" class="{{ Request::path() === 'articles' ? 'current_page_item' : '' }}"><a href="/articles"  accesskey="4" title="">Articles</a></li>
					@auth
						<li id="hvr" class="{{ Request::path() === 'profile' ? 'current_page_item' : '' }}"><a href="/profile"  accesskey="5" title="">{{ Auth::user()->name }}'s Profile</a></li>
					@else
						<li id="hvr" class="{{ Request::path() === 'profile' ? 'current_page_item' : '' }}"><a href="/profile"  accesskey="5" title="">My Profile</a></li>
					@endauth
				</ul>
			</div>
		</div>
		@yield('header')
	</div>
	@yield('content')
</body>
<div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a> | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
</div>
</html>
