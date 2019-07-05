@extends('layouts.app', ['title' => $title])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default card-rbec">
                    <div class="card-header">
                        <h2>Post Reports
                        </h2>
                    </div>
                    @include('partials.success-message')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Post Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Date Reported</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($reports as $report)
                                    <tr>
                                        <td>
                                            <a href="/posts/{{ $report->post->id }}">{{ $report->post->title }}</a>
                                        </td>
                                        <td>
                                            {{ $report->category }}
                                        </td>
                                        <td>
                                            {{ $report->description }}
                                        </td>
                                        <td>
                                            {{ $report->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                        </td>
                                        <td>
                                            <a class="btn btn-default float-left" style="margin-right: 5px;"
                                               href="{{ route('reports.post-review', ['report' => $report->id]) }}"><i
                                                        class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $reports->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection