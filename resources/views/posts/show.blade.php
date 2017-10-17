@extends('layouts.app', ['title' => $post->title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 blog-main">
                    <div class="blog-post-meta">Posted {{ $post->date_published->format('d/m/Y H:i')}} by <a>{{ $post->user->name }}</a></div>
                    <div class="panel panel-default panel-rbec">
                        <div class="panel-body">
                            {{ $post->body }}
                        </div>
                    </div>
                    @if($post->comments->count())
                        <h2>Comments:</h2>

                        <ul class="list-group">
                            @foreach($post->comments as $comment)
                                <strong>{{ $comment->created_at->diffForHumans() }} by <a
                                            href="#">{{ $comment->commenter_name }}</a> </strong>
                                <li class=list-group-item>
                                    {{ $comment->body }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>Add a Comment: </h3>
                    <div class="card">
                        <div class="card-block">
                            <form method="post" action="/posts/{{$post->id}}/comments">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @if (Auth::guest())
                                        Name: <input type="text" value="{{ $post->commenter_name }}"
                                                     name="commenter_name" placeholder="Please insert your name "> *
                                    @else
                                        <input type="hidden" value="{{ Auth::user()->name }}" name="commenter_name">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="hidden" value="{{$post->id}}" name="post_id">
                                    <textarea name="body" placeholder="Your comment here..." class="form-control">

                                </textarea>
                                </div>


                                @include ('partials.errors')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('partials.sidebar')
            </div>
        </div>
    </div>
@endsection