<title>Edit Article</title>

@include('layouts.nav')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha3104-Vkoo10x4CGsO3+Hhxv10T/Q5PaXtkKtu10ug5TOeNV10gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
<body>
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
		<form action="/articles/{{ $article->id }}" method="POST">
				@csrf
				@method('PUT')
				<h1>Edit Article</h1>
				<br>
				<br>
				<div class="form-group row">
					<label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Titile') }}</label>
					<div class="col-md-10">
						<input 
							id="title" 
							type="text" 
							class="form-control @error('title') is-invalid @enderror"
							name="title" 
							value="{{ $article -> title }}" 
							required autocomplete="title" 
							autofocus>
							@error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					</div>
				</div>
				
				<div class="form-group row">
					<label for="excerpt" class="col-md-2 col-form-label text-md-right">{{ __('Excerpt') }}</label>
					<div class="col-md-10">
						<input 
							id="excerpt" 
							type="text" 
							class="form-control @error('excerpt') is-invalid @enderror"
							name="excerpt" 
							value="{{ $article -> excerpt }}" 
							required autocomplete="excerpt" 
							autofocus>
							@error('excerpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="body" class="col-md-2 col-form-label text-md-right">{{ __('Body') }}</label>
					<div class="col-md-10">
							<textarea 
								id="body" 
								class="form-control @error('body') is-invalid @enderror"  
								name="body" 
								required autocomplete="body" 
								autofocus>{{ $article -> body }}</textarea>
						@error('body')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
                        @enderror
					</div>
				</div>
				<div >
				
					<button type="submit" class="btn btn-primary" style="float:right">Submit</button>
				
				</div>
		</form>
		</div>
		@include('ownsidebar')
	</div>
</div>
</body>
<div>
@include('layouts.footer')
</div>
