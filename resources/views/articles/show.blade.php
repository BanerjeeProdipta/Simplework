<title>{{$article -> title}}</title>
@extends('layout')
@section('content')
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>{{ $article -> title}}</h2>
				<div>
					<div class="d-flex justify-content-between">
						<p>Written by <a href="/articles?written_by={{ $article -> User -> name }}">{{ $article -> User -> name }}</a></p>
						<p>{{$article->created_at}}</p>
					</div>
					<span class="byline">{{ $article ->excerpt}}</span>
				</div>
			</div>
				@if(!is_null($article->photo_name))
				<p><img src= "/uploads/articles/{{$article->photo_name}}" alt="" class="image image-full"/></p>
				@endif
				<body><p>{{ $article -> body}}</p>
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
				<form method="POST" action="/reply/{{ $article->id }}">
					@csrf
					@if(session()->has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
					@endif
					@if(session()->has('warning'))
                        <div class="alert alert-warning">{{ Session::get('warning') }}</div>
					@endif
					@if(session()->has('danger'))
                        <div class="alert alert-danger">{{ Session::get('danger') }}</div>
					<h4>Do you want to reply to this article?</h4>
                    @endif
					<br>
					<div class="form-group row">
						<div class="col-md-12">
							<textarea 
								id="reply" 
								type="text" 
								class="form-control @error('reply') is-invalid @enderror" 
								name="reply" 
								value="{{ old('reply') }}" 
								required autocomplete="reply" 
								placeholder="Write a comment"
								></textarea>
								@error('reply')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
								@enderror
							
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-sm" style="float: right;">Submit</button>
				</form>
				
				@forelse ($replies as $reply)
					<div>
						<br>
						<br>
						
						<div class="d-flex justify-content-between">
							<h5>{{$reply->user->name}} said</h5>
							<p style="float: right">{{$reply->created_at->diffForHumans()}}</p>
						</div>

						@if ($article->best_reply_id == $reply->id)
							<span style="color: cornflowerblue" >Best Reply!</span>
						@endif
						
						<p>{{$reply->reply}}</p>
						<div>
						
						{{-- Update Reply --}}
						@can('update', $reply)
							<a href="/article/{{$article->id}}/reply/{{$reply->id}}/edit" class="btn-sm btn btn-light text-muted" style="float: left;">Edit</a>
						@endcan
						</div>

						{{-- Delete Reply --}}
						@can('delete', $reply)
						<form method="POST" action="/article/{{$article->id}}/reply/{{$reply->id}}/delete">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn-sm btn btn-light text-muted" style="float: left;">Delete</button>
						</form>
						@endcan

						{{-- Best Reply --}}
						@can('update', $article)
							<form action="/best_reply/{{$reply->id}}" method="POST">
						@csrf
							<button type="submit" class="btn-sm btn btn-light text-muted" style="float: right">Best Reply?</button>
						</form>
						@endcan

					</div>
				@empty
					<br>
					<br>
					<p>No Comments Yet!</p>
				@endforelse
			</div>
		@include('sidebar')
	</div>
</div>


@endsection