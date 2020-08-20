<title>Articles</title>

@extends('layout')
@section('content')
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			@if(session()->has('success'))
				<div class="alert alert-success">{{ Session::get('success') }}</div>
			@endif
			@if(session()->has('warning'))
				<div class="alert alert-warning">{{ Session::get('warning') }}</div>
			@endif
			@if(session()->has('danger'))
				<div class="alert alert-danger">{{ Session::get('danger') }}</div>
			@endif
		@forelse ($articles as $article)
			<div class="title">
				<a href="/articles/{{ $article -> id }}" style="text-decoration:none"><h2>{{ $article ->title}}</h2></a>
				<div class="d-flex justify-content-between">
				<p >Written by <a href="/articles?written_by={{ $article -> User -> name }}">{{ $article -> User -> name }}</a></p>
				<p >{{$article->created_at->format('M d Y')}}</p>
				</div>
				<span class="byline">{{ $article ->excerpt}}</span>
			</div>
				@if(!is_null($article->photo_name))
				<p><img src= "/uploads/articles/{{$article->photo_name}}"
					alt="" class="image image-full"/></p>
				 @endif
				 
				<body>
					<p>{{ $article ->body}}</p>
					<br>
				</body>
				<div class="d-flex justify-content-between">
					<p>
						@foreach ($article->tags as $tag)
						<a href="/articles?tag={{ $tag->name }}" >{{ $tag -> name }}</a>
						@endforeach
					</p>
					<div>
						@can('update', $article)
						<a href="/articles/{{ $article -> id }}/edit">Edit</a>
						@endcan
						@can('delete', $article)
						<a href="/articles/{{ $article -> id }}/delete">Delete</a>
						@endcan
					</div>
				</div>
				@empty<p>No articles yet!</p>
		@endforelse
		</div>
		@include('sidebar')
	</div>
</div>
@endsection
