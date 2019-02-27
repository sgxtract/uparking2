@extends('layouts.admin')

@section('title')
Admin Users
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title"><span class="mdi mdi-account-plus"></span> Create New User</h4>

                        @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-ticked">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <hr>

                        <form action="{{ route('adminAddNewUser') }}" method="POST">
                            @csrf

                            <p class="card-description">
                                <strong>Personal info</strong>
                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="First Name"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last Name"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                             <input type="phone_number" name="phone_number" class="form-control" id="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password" id="password" placeholder=" Password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Permissions</label>
                                        <div class="col-sm-9">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <label for="staff" class="mt-1">Staff</label>
                                                    <input name="staff" type="checkbox" id="staff" value=1>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="admin" class="mt-1">Admin</label>
                                                    <input name="admin" type="checkbox" id="admin" value=1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-info mr-2">Create new user</button>
                            <a href="{{ route('adminUsers') }}" class="btn btn-secondary float-right">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
