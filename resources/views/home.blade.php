@extends('layouts.master')

@section('title')
    Parking Ally
@endsection

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset($home->image) }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>{{ $home->title }}</h1>
                    <span class="subheading">{{ $home->sub_title }}</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>
                {{ $home->description }}
            </p>
        </div>
    </div>
</div>
@endsection
