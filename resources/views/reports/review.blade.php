@extends('layouts.app', ['title' => $title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default card-rbec">
                    <div class="card-body">
                        <p>{{ $report->post->title }}</p>
                        <p>{{ $report->post->body }}</p>
                    </div>
                </div>

                <div class="card card-default card-rbec">
                    <div class="card-header">
                        Report Details
                    </div>
                    <div class="card-body">
                        <p>{{ $report->category }}</p>
                        <p>{{ $report->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection