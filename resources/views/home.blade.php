<title>Create New Article</title>

@include('layouts.nav')
<body>
	<div id="wrapper">
		<div id="page" class="container">
			<div id="content">
			<form method="POST" action="/articles" enctype="multipart/form-data">
				@csrf
				<h1>New Article</h1>
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
							value="{{ old('title') }}" 
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
							value="{{ old('excerpt') }}" 
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
							autofocus>{{ old('body') }}</textarea>
							@error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="tags" class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</label>
					<div class="col-md-10">
							<select class ="form-control @error('tags') is-invalid @enderror" multiple name="tags[]">
							@foreach ($tags ?? '' as $tag)
								<option value="{{ $tag->id }}">{{ $tag->name}}</option>
							@endforeach</select>
							@error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>
					<div class="col-md-10">
						<div class="custom-file">
						<input type="file" name="image" class="custom-file-input">
						<label class="custom-file-label">Upload an Image</label>
						</div>
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