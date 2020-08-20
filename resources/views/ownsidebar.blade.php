<div id="sidebar">
    <h2>My Articles</h2>
    <br>
    <ul class="style1">
        @forelse ($articles as $article)
        <li class="first">
        <h3> 
            <a href="/articles/{{ $article -> id }}"> {{ $article-> title }}</a>
        </h3>
        <div class="d-flex justify-content-between">
            <p>Written by <a href="/articles?written_by={{ $article -> User -> name }}">{{ $article -> User -> name }}</a></p>
            <p>{{$article->created_at->diffForHumans()}}</p>
        </div>
        <p>{{ $article -> excerpt}}</p>
        @can('update', $article)
        <a href="/articles/{{ $article -> id }}/edit">Edit</a>
        @endcan
        @can('delete', $article)
        <a href="/articles/{{ $article -> id }}/delete">Delete</a>
        @endcan
        </li>
        @empty
            No Articles Available
        @endforelse
    </ul>
</div>