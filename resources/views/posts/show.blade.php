@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $post->title }}</h1>
            </div>

        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-body">
                        {{ $post->body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection