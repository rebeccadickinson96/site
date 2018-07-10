@extends('layouts.app', ['title' => 'Users'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading">

                    </div>
                    <div class="panel-body">
                        {{ $users }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection