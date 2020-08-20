<title>Payment</title>
@include('layouts.nav')
<body>
<div id="wrapper">
	<div id="page" class="container">
        <div id="content">
        <form method="POST" action="/payment">
            <h1>Make Payment</h1>
            @csrf
            <br>
            <br>
            
            @if(session()->has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            
            <div class="form-group row">
                <div class="container">
                <button type="submit" class="btn btn-primary">
                    {{ __('Pay $10') }}
                </button>
                </div>
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