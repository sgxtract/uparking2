@extends('layouts.admin')

@section('title')
    User Profile
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Account Settings</h4>
                        <form action="" method="POST">
                            @csrf
                            <h4>General Information</h4>
                            <p class="card-description">
                                <small>These information are visible to the public.</small>
                            </p>

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-ticked">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="First Name" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control" placeholder="Last Name" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="Email" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone_number" value="{{ Auth::user()->phone_number }}" class="form-control" placeholder="Phone Number" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4>Change Password</h4>
                            <p class="card-description">
                                <small>Change password here.</small>
                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Current Password</label>
                                        <div class="col-sm-8">
                                            <input name="password" type="password" class="form-control" placeholder="********" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">New Password</label>
                                        <div class="col-sm-8">
                                            <input name="new_password" type="password" class="form-control" placeholder="********" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Confirm New Password</label>
                                        <div class="col-sm-8">
                                            <input name="new_password_confirmation" type="password" class="form-control" placeholder="********" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <button type="submit" class="btn btn-info">Save Changes</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
