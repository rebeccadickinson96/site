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
                        <div class="blog-post-meta">{{ $post->created_at->diffForHumans()}}</div>
                        {{ $post->body }}
                        <div class="blog-post-meta">Comments:({{ $post->comments->count()}})</div>

                    </div>
                @endforeach
                {{ $posts->render() }}
            </div>

            <div class="col-md-4">
                <div class="blog-sidebar">
                    <div class="sidebar-module">
                        <h2>Categories</h2>
                        <ol class="list-unstyled">
                            @foreach($categories as $cat)
                                <li><a href="">{{$cat->category}}</a></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection