@extends('layouts.app', ['title' => 'Posts Index'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading">
                        <h2>Posts List<a href="/posts/create" class="btn-add btn btn-primary pull-right">New Post +</a>
                        </h2>
                    </div>
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
                                        <td>{{ strlen($post->body)>75 ? substr($post->body,0,75)."..." : $post->body}}</td>
                                        <td>{{ $post->date_published->diffForHumans() }}</td>
                                        <td><a class="btn btn-default pull-left" style="margin-right: 5px;"
                                               href="/posts/{{ $post->id }}"><i
                                                        class="fa fa-eye"></i></a>
                                            <a class="btn btn-default pull-left" style="margin-right: 5px;"
                                               href="/posts/{{ $post->id }}/edit"><i
                                                        class="fa fa-edit"></i></a>
                                            <form action="/posts/{{$post->id}}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
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