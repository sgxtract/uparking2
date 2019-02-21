<style>
    .fancy-checkbox-label > input[type=radio] {
      position: absolute;
      opacity: 0;
      cursor: inherit;
    }
    .fancy-checkbox-label {
      font-weight: normal;
      cursor: pointer;
    }
</style>

@extends('layouts.admin')

@section('title')
Reserve
@endsection

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 grid-margin stretch-card">
                <!--reserve card-->
                <div class="card" style="background-image: url(" {{ asset('images/reserve.jpg') }}");">
                    <div class="card-body">
                        <h4>Reserve a slot</h4>
                        <p class="card-description">
                            <small>These are the list of your registered vehicles.</small>
                        </p>
                        <hr>

                        @if (session('success2'))
                        <div class="alert alert-danger">
                            {{ session('success2') }}
                        </div>
                        @endif

                        <div class="row">
                            {{-- cars start --}}
                            <div class="col-md-12">
                                {{-- Slot 1 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 133px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 1" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 2 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 166px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 2" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 3 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 209px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 3" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 4 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 240px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 4" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 5 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 283px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 5" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 6 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 314px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 6" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 7 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 357px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 7" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 8 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 389px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 8" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 9 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 431px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 9" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 10 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 462;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 10" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 11 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 505px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 11" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 12 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 540px;top: 615px;">
                                    <input type="radio" onclick="func()" value="Slot 12" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 13 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 787px;top: 555px;">
                                    <input type="radio" onclick="func()" value="Slot 13" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-pwd.png') }}" width="55" height="27">
                                </label>
                                {{-- Slot 14 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 787px;top: 588px;">
                                    <input type="radio" onclick="func()" value="Slot 14" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-pwd.png') }}" width="55" height="27">
                                </label>
                                {{-- Slot 15 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 133px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 15" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 16 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 167px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 16" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 17 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 211px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 17" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 18 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 244px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 18" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 19 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 284px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 19" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 20 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 315px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 20" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 21 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 358px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 21" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 22 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 390px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 22" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 23 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 432px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 23" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 24 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 465px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 24" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 25 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 507px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 25" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 26 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 538px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 26" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 27 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 578px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 27" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 28 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 612px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 28" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 29 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 654px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 29" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 30 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 685px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 30" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 31 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 728px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 31" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 32 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 759px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 32" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 33 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 803px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 33" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 34 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 836px;top: 256px;">
                                    <input type="radio" onclick="func()" value="Slot 34" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 35 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 201px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 35" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 36 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 235px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 36" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 37 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 278px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 37" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 38 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 309px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 38" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 39 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 350px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 39" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 40 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 382px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 40" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 41 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 425px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 41" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 42 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 456px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 42" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 43 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 500px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 43" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 44 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 530px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 44" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 45 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 572px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 45" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 46 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 604px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 46" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 47 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 647px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 47" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 48 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 680px;top: 380px;">
                                    <input type="radio" onclick="func()" value="Slot 48" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-top.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 49 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 201px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 49" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 50 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 235px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 50" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 51 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 278px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 51" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 52 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 309px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 52" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 53 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 350px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 53" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 54 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 382px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 54" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 55 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 425px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 55" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 56 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 456px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 56" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 57 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 500px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 57" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 58 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 530px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 58" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 59 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 572px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 59" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 60 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 604px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 60" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 61 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 647px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 61" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                {{-- Slot 62 --}}
                                <label class="fancy-checkbox-label" id="myBtn" data-toggle="modal" data-target="#myModal"
                                    style="position: absolute;left: 680px;top: 468px;">
                                    <input type="radio" onclick="func()" value="Slot 62" name="slots">
                                    <span class="fancy-checkbox fancy-checkbox-img"></span>
                                    <img src="{{ asset('images/cars/car-grey-btm.png') }}" width="27" height="55">
                                </label>
                                <img src="{{ asset('images/reserve.jpg') }}" alt="" width="1150">
                            </div>
                            {{-- cars end --}}
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel"></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ route('checkIn', '') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <h5>Enter plate no. (ABC####)</h5>
                                                            <div class="input-group col-xs-12">
                                                                <input type="text" name="plate_number" class="form-control text-center" placeholder="ABC####">
                                                                <span class="input-group-append">
                                                                    <button type="submit" class="btn btn-dark btn-fw">
                                                                        <i class="mdi mdi-map-marker-radius"></i>Check In</button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- Parking Information --}}
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Parking Information <span class="mdi mdi-information-variant"></span></h5>
                                                    <hr>
                                                    <div class="row mt-3">
                                                        <div class="col-md-4">
                                                            <p>Parking Rate:</p>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>₱ 50.00 first two (2) hours.</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p>Hourly Rate:</p>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p>₱ 25.00 / hr.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Parking Information End --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End -->
                        </div>
                    </div>
                </div>
                <!--reserve card ends-->
            </div>
        </div>
    </div>
</div>

<script>
    function func() {
        var val = document.querySelector('input[name="slots"]:checked').value;
        document.getElementById("myModalLabel").innerHTML = '<span class="mdi mdi-car"></span> Selected ' + val;
    }

</script>
@endsection
