<title>{{auth()->user()->name}}'s Profile</title>

@include('layouts.nav')
<body>
<div id="wrapper">
    <div id="page" class="container">
        <div id="content">		
            <h1>My Activity</h1>
            @csrf
            <br>
            @can('view', $users)
                <div class="col-11">
                    <div class="d-flex justify-content-between">
                        <h4>All Users</h4>
                    </div>
                    <br>    
                    <table class="table table-hover; table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Article Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            @forelse ($users as $user)
                                <td><a href="/articles?written_by={{ $user -> name }}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->articles->count()}}</td>    
                            </tr>
                            @empty
                                No User Available!
                            @endforelse
                            
                        </tbody>
                    </table>
        
                    <div style="float: right">
                        {{ $users->links('vendor.pagination.customized') }}
                    </div>
                </div>
            @endcan
            <br>
            <br>
            <br>
            <div class="form-group row "> 
                <div class="col-6 ">
                    <h4>My Articles</h4>
                    <ul>
                    @forelse ($articles as $article)
                    <li>
                        <a href="/articles/{{ $article -> id }}" style="padding-bottom:15px"> {{ $article-> title }}</a>
                    </li> 
                    @empty
                        You do not have any articles yet!
                    @endforelse
                    </ul>
                </div>
                <div class="col-6">
                    <h4>My Comments</h4>
                    <ul>
                    @forelse ($replies as $reply)
                    <li>
                    <a href="/articles/{{ $reply -> article_id }}"> {{ $reply-> reply }} on {{$reply->article->title}}</a>
                    </li>
                    @empty
                        You have not commented on any article yet!
                    @endforelse
                    </ul>
                </div>
            </div>
    
        </div>	
        <h1>Replies on my article</h1>
        <br>
        <ul>
            <h4>Unread Comments</h4>
            @forelse ($unreadNotifications as $notification)
            {{$unreadNotifications -> markAsRead()}}
            <li>
                @if( $notification->type == 'App\Notifications\ArticleReply')
                    
                    <div class="d-flex justify-content-between">
                        <a href="/articles/{{$notification->data['article_id'] }}">
                            <p><strong>{{$notification->data['commenter'] }}</strong> commented <strong>{{$notification->data['reply'] }}</strong> on <strong>{{$notification->data['article'] }}</strong></p>
                        </a>
                        <p>{{$notification->created_at->diffForHumans()}}</p>
                    </div>
                    
                @endif
            </li>
            @empty
            <li>You have no unread comments on your at the moment.</li>
            @endforelse
        </ul>
        <ul>
            <h4>Read Comments</h4>
            @forelse ($readNotifications as $notification)
            {{$readNotifications -> markAsRead()}}
            <li>
                @if( $notification->type == 'App\Notifications\ArticleReply')
                    
                    <div class="d-flex justify-content-between">
                        <a href="/articles/{{$notification->data['article_id'] }}">
                            <p><strong>{{$notification->data['commenter'] }}</strong> commented <strong>{{$notification->data['reply'] }}</strong> on <strong>{{$notification->data['article'] }}</strong></p>
                        </a>
                            <p>{{$notification->created_at->diffForHumans()}}</p>
                    </div>
                    
                @endif
            </li>
            @empty
            <li>You have no comments on your at the moment.</li>
            @endforelse
        </ul>
    </div>
</div>
</body>
<div>
@include('layouts.footer')
</div>
