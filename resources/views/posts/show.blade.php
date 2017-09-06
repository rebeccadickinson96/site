@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1>{{ $post->title }}</h1>

        <div class="panel panel-default panel-rbec">
            <div class="panel-body">
                {{ $post->body }}
            </div>
        </div>
    </div>
@endsection