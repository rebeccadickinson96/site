@extends('layouts.app', ['title' => $title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <a href="/posts">All</a>

                <a href="/posts/published">Published</a>

                <a href="/posts/scheduled">Scheduled</a>

                <a href="/posts/drafts">Drafts</a>

                <a href="/posts/pending">Pending</a>

                <a href="/posts/declined">Declined</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default card-rbec">
                    <div class="card-header">
                        <h2>Posts List<a href="/posts/create" class="btn-add btn btn-primary float-right">New Post +</a>
                        </h2>
                    </div>
                    @include('partials.success-message')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th>Tags</th>
                                    <th>Publish Date</th>
                                    <th>Status</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        <td><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                                        <td>
                                            @if($post->categories->count() >= 1)

                                                @foreach($post->categories->pluck('category') as $cat)
                                                    {{ $cat }}<br>
                                                @endforeach

                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $post->date_published->format('d/m/Y H:i') }}</td>
                                        <td>
                                            {{ $post->status() }}
                                        </td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>
                                            <a class="btn btn-default float-left" style="margin-right: 5px;"
                                               href="/posts/{{ $post->id }}/edit" id="edit{{$post->id}}"><i
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
                    <div class="card-footer">
                        {{ $posts->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection