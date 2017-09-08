@extends('layouts.app', ['title' => $post->title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-body">
                        {{ $post->body }}
                    </div>
                </div>
                @if($post->comments->count())
                    <h2>Comments:</h2>

                    <ul class="list-group">
                        @foreach($post->comments as $comment)
                            <strong>{{ $comment->created_at->diffForHumans() }} by user </strong>
                            <li class=list-group-item>
                                {{ $comment->body }}
                            </li>gi
                        @endforeach
                    </ul>
                @endif
                @if (Auth::guest())
                    Please Login or register to comment.
                @else
                    <h3>Add a Comment: </h3>
                    <div class="card">
                        <div class="card-block">
                            <form method="post" action="/posts/{{$post->id}}/comments">
                                {{ csrf_field() }}
                                <div class="form-group">
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
                @endif
            </div>
        </div>
    </div>
@endsection