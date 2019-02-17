@extends('layouts.admin')

@section('title')
    Edit ( {{ $user->name . ' ' . $user->last_name }} )
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-2 col-xl-2 col-lg-2"></div>
            <div class="col-md-8 col-xl-8 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit ( {{ $user->name . ' ' . $user->last_name }} )</h4>
                        @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('adminEditUserAccount', $user->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}"
                                    placeholder="First Name">
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}"
                                    placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}"
                                    placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="phone_number" name="phone_number" class="form-control" id="phone_number" value="{{ $user->phone_number }}"
                                    placeholder="Phone Number">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="staff" class="mt-1">Staff</label>
                                        <input name="staff" type="checkbox" id="staff" value=1 {{ $user->staff == true ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="admin" class="mt-1">Admin</label>
                                        <input name="admin" type="checkbox" id="admin" value=1 {{ $user->admin == true ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info mr-2">Update</button>
                            <a href="{{ route('adminUsers') }}" class="btn btn-secondary float-right">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
