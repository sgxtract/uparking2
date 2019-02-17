@extends('layouts.master')

@section('title')
    Parking Ally
@endsection

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset('assets/img/parking-bg.jpeg') }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>{{ env('APP_NAME') }}</h1>
                    <span class="subheading">Parking made easy</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            
        </div>
    </div>
</div>
@endsection
