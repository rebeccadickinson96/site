@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                @foreach($posts as $post)
                    <div class="panel panel-default panel-rbec">
                        <div class="panel-heading">
                            <h2><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h2>
                        </div>
                        <div class="panel-body">
                            {{ $post->body }}
                        </div>

                        <div class="panel-footer">
                            {{ $post->created_at->diffForHumans()}}
                        </div>
                    </div>
                @endforeach
                {{ $posts->render() }}
            </div>
        </div>
    </div>
@endsection