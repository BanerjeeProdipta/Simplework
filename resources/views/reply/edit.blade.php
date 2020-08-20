<title>Article</title>
@extends('layout')
@section('content')
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>{{ $article -> title}}</h2>
				<div>
					<p><a href="/articles?written_by={{ $article -> User -> name }}">Written by {{ $article -> User -> name }}</a></p>
					<span class="byline">{{ $article ->excerpt}}</span>
				</div>
			</div>
				<p><img src= "/uploads/articles/{{$article->photo_name}}"
				 alt="" class="image image-full" /> </p>
			
				<body><p>{{ $article -> body}}</p>
					<p>
						@foreach ($article->tags as $tag)
						<a href="/articles?tag={{ $tag->name }}" >{{ $tag -> name }}</a>
						@endforeach
					</p>
				</body>
				<form method="POST" action="/article/{{$article->id}}/reply/{{$reply->id}}/update">
					@csrf
					@method('PUT')
					<h4>Edit Comment</h4>
					<br>
					<div class="form-group row">
						<div class="col-md-12">
							<textarea 
								id="reply" 
								class="form-control @error('reply') is-invalid @enderror" 
								name="reply" 
								required autocomplete="reply" 
								autofocus
								>{{ $reply -> reply }}</textarea>
								@error('reply')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-sm" style="float: right;">Submit</button>
				</form>
				{{-- @forelse ($article->replies as $reply)
					<div>
						<br>
						<br>
						
						<h5>{{$reply->user->name}} said</h5>
						
						@if ($article->best_reply_id == $reply->id)
								<span style="color: cornflowerblue" >Best Reply!</span>
						@endif
						<p style="float: right">{{$reply->created_at->diffForHumans()}}</p>
						<p>{{$reply->reply}}</p>

						<a href="" style="float: right;padding:0">Delete</a>
						<a href="" style="float: right;padding-right:2em">Edit</a>
						
						@can('update', $article)
						<form action="/articles/{{$article->id}}/best_reply/{{$reply->id}}" method="POST">
							<form action="/best_reply/{{$reply->id}}" method="POST"> 
						@csrf
							<button type="submit" class="btn-sm btn btn-light text-muted">Best Reply?</button>
						</form>
						@endcan
					</div>
				@empty
					<br>
					<br>
					<p>No Comments Yet!</p>
				@endforelse --}}
			</div>
		@include('sidebar')
		</div>
	</div>
</div>

@endsection