<title>Contact</title>

@include('layouts.nav')
<body>
<div id="wrapper">
	<div id="page" class="container">
        <div id="content">
            <form method="POST" action="/contact">
                
                <h1>Send Email</h1>
                @csrf
                <br>
                <br>
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="form-group row d-flex">
                    <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send') }}
                    </button>
                </div>
            </form>
        </div>
    @include('ownsidebar')	
	</div>
</div>
</body>
@include('layouts.footer')
</div>
