@extends('layouts.admin')

@section('title')
Content Management
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><span class="mdi mdi-pencil"></span> Manage Contact Page</h4>
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
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <hr>

                        <h4>Change Contact Content</h4>
                        <p class="card-description">
                            <small>Change the content of the contact page.</small>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <form action="{{ route('admin.changeContact') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" value="{{ $contact->title }}" class="form-control" id="title" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="sub-title">Sub-title</label>
                                        <input type="text" name="sub_title" value="{{ $contact->sub_title }}" class="form-control" id="sub-title" placeholder="Sub-title">
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Change background image</label>
                                        <input type="file" name="bg_img" class="form-control" id="file" placeholder="file">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="5">{{ $contact->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Save changes</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
