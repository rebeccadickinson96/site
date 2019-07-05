@extends('layouts.app', ['title' => ''])
@section('content')
    <div class="container" id="comments">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default card-rbec">
                    <div class="card-header">
                        <h2>
                            Pending Comments
                        </h2>
                    </div>
                    @include('partials.success-message')
                    <div class="card-body">
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
                                            <form method="post" class=form-inline"
                                                  action="{{ route('comments.approve', ['comment'=> $comment->id]) }}">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <select class="form-control" name="action">
                                                        <option value="approve" selected>
                                                            Approve
                                                        </option>
                                                        <option value="decline">
                                                            Decline
                                                        </option>
                                                    </select>
                                                    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i></button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $comments->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection