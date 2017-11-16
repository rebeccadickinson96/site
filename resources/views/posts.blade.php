@extends('layouts.app', ['title' => config('app.name', 'Laravel')])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                @foreach($posts as $post)
                    <div class="blog-post">

                        <div class="blog-post-title">
                            <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                        </div>
                        <div class="blog-post-meta">{{ $post->date_published->diffForHumans()}} by
                            <a>{{ $post->user->name }}</a>
                            @if($post->categories->count() >= 1) Tags:
                                @foreach($post->categories->pluck('category') as $cat)
                                <a href="/tags/{{ $cat }}">{{ $cat }}</a>
                                @endforeach
                            @endif
                        </div>
                        {{ $post->body }}
                        <div class="blog-post-meta">Comments:({{ $post->comments->count()}})</div>
                    </div>
                @endforeach
                {{ $posts->render() }}
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@endsection