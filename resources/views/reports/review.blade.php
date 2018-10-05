@extends('layouts.app', ['title' => $title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default panel-rbec">
                    <div class="panel-body">
                        <p>{{ $report->post->title }}</p>
                        <p>{{ $report->post->body }}</p>
                    </div>
                </div>

                <div class="panel panel-default panel-rbec">
                    <div class="panel-heading">
                        Report Details
                    </div>
                    <div class="panel-body">
                        <p>{{ $report->category }}</p>
                        <p>{{ $report->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection