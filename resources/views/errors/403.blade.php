@extends('layouts.app',['title' => '403 Access Denied!'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        <h3 class="text-center">You do not have permission to view this page.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection