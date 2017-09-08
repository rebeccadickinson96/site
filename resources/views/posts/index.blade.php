@extends('layouts.app', ['title' => 'Posts Index'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading"><h2>Posts List</h2></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->body }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td><a class="btn btn-default pull-left" style="margin-right: 5px;"
                                               href="/posts/{{ $post->id }}"><i
                                                        class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer">
                        {{ $posts->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection