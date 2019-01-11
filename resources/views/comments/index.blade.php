@extends('layouts.app', ['title' => ''])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading">
                        <h2>
                            Pending Comments
                        </h2>
                    </div>
                    @include('partials.success-message')
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Post Title</th>
                                    <th>Commenter</th>
                                    <th>Body</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            <a href="/posts/{{ $comment->post->id }}">{{ $comment->post->title }}</a>
                                        </td>
                                        <td>
                                            {{ $comment->commenter_name }}
                                        </td>
                                        <td>
                                            {{ $comment->body }}
                                        </td>
                                        <td>
                                            {{ $comment->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        {{ $comments->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection