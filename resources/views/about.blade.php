@extends('layouts.master')

@section('content')
<!-- Page Header -->
<header class="masthead" style="background-image: url('{{ asset($about->image) }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>{{ $about->title }}</h1>
                    <span class="subheading">{{ $about->sub_title }}</span>
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
                {{ $about->description }}
            </p>
        </div>
    </div>
</div>
@endsection
