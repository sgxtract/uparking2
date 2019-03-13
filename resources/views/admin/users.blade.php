@extends('layouts.admin')

@section('title')
    Admin Users
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-account-multiple"></span> Admin Users</h4>
                        <a href="{{ route('adminNewUser') }}" class="badge badge-info">Create new user <span class="mdi mdi-account-plus"></span></a>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {!! session('error') !!}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <hr>

                        <div class="table-responsive">
                            <table id="adminUsers" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Last login</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><a href="{{ route('adminSingleUser', $user->id) }}">{{ $user->name . ' ' . $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>
                                                @if ($user->status)
                                                    Activated
                                                @else
                                                    Deactivated
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->last_sign_in_at)->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('adminEditUser', $user->id) }}" class="badge badge-warning"><span class="mdi mdi-pencil"></span> Edit</a>
                                                <form style="display: none" method="POST" id="activateUser-{{ $user->id }}" action="{{ route('adminActivateUser', $user->id) }}">@csrf</form>
                                                <a href="#" class="badge badge-success" onclick="activate('{{ $user->id }}')"><span class="mdi mdi-key"></span> Activate</a>
                                                <form style="display: none" method="POST" id="deactivateUser-{{ $user->id }}" action="{{ route('adminDeleteUser', $user->id) }}">@csrf</form>
                                                <a href="#" class="badge badge-danger" onclick="deactivate('{{ $user->id }}')"><span class="mdi mdi-key-remove"></span> Deactivate</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Status</th>
                                        <th>Last login</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#adminUsers').DataTable();
    } );

    function deactivate($id){
        swal({
            title: "Are you sure?",
            text: "Once deactivated, the user may not be able to login.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                document.getElementById('deactivateUser-' + $id).submit()
                swal("The user has been deactivated.", {
                icon: "success",
                });
            } else {
                swal("The account is still active!");
            }
        });
    }

    function activate($id){
        swal({
            title: "Are you sure?",
            text: "The user will be re-activated again and may use the account.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                document.getElementById('activateUser-' + $id).submit()
                swal("The user is now active.", {
                icon: "success",
                });
            } else {
                swal("The account is still deactivated.");
            }
        });
    }
</script>

@endsection
