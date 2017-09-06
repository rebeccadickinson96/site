@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading"><h2>Categories</h2></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Category Number</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                </tr>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id}}</td>
                                        <td>{{ $category->category}}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </div>
                    <div class="panel-footer">
                        {{ $categories->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
