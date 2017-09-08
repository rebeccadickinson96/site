@extends('layouts.app', ['title' => 'Create a post'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="/posts">

                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>

                    <div class="form-group">
                        <label for="body">Post</label>
                        <textarea class="form-control" id="body" name="body"></textarea>
                    </div>
                    @include ('partials.errors')
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection