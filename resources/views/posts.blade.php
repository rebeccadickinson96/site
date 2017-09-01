@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-rbec">
                <div class="panel-heading"><h2>Posts List</h2></div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th>Body</th>
                            <th>Created At</th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->created_at }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                    {{ $posts->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
