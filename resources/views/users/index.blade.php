@extends('layouts.app', ['title' => 'Users'])
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default card-rbec">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <table id="usersIndex" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name }}</td>
                                    <td> {{ $user->id }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        $(document).ready( function () {
            $('#usersIndex')
                .addClass( 'nowrap' )
                .dataTable( {
                    responsive: true,
                    columnDefs: [
                        { targets: [-1, -3], className: 'dt-body-right' }
                    ]
                } );
        } );
    </script>
@endsection