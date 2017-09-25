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

                    <div class="form-group">
                        <label for="date_published">Date Created</label>
                        <input type="text" class="form-control timepicker" id="date_published" name="date_published"
                               value="{{ Carbon\Carbon::now()->format('d/m/Y H:i') }}">
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