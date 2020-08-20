<title>Notifications</title>

@include('layouts.nav')
<body>
<div id="wrapper">
    <div id="page" class="container">
        <div id="content">		
        <form method="POST" action="/payment">
            <h1>Notification</h1>
            @csrf
            <br>
            <br>
            <div class="form-group row mb-0">
                <div class="col-md-8 ">
                    <h5>Unread Notifications</h5>
                    <ul>
                        @forelse ($unreadNotifications as $notification)
                        {{$unreadNotifications -> markAsRead()}}
                            <li>
                                @if( $notification->type == 'App\Notifications\PaymentReceived')
                                We have received a payment of ${{$notification->data['amount'] }} from you {{$notification->created_at->diffForHumans()}}.
                                @endif
                            </li>
                            @empty
                            <li>You have no unread notification at the moment.</li>
                        @endforelse
                    </ul>
                    <h5>Previous Notifications</h5>
                    <ul>
                        @forelse ($readNotifications as $notification)
                            <li>
                                @if( $notification->type == 'App\Notifications\PaymentReceived')
                                We have received a payment of ${{$notification->data['amount'] }} from you {{$notification->created_at->diffForHumans()}}.
                                @endif
                            </li>
                            @empty
                            <li>You have no notification at the moment.</li>
                        @endforelse
                    </ul>
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
