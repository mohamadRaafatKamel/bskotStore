
@extends('layouts.site')
@section('title', 'view')

@section('toppage')
    <div class="topproducy">
        <a href="{{route('product',$product->cat_id)}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
    <div class="view" style="background-image: url('{{asset($product->img)}}'); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Contenttop-nav-collapse -->
            <div class="text-center white-text mx-5 wow fadeIn">

                <!--Img-->
            </div>
            <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

    </div>
    <div class="sec-nav">
        <div>
            <h1>{{$product->name_en}}</h1>
        </div>
    </div>
@stop
@section('main')
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')

<main>
    <div class="grayline"></div>
    <div class="price">
        <p class="first">Price : </p>
        <p class="second">{{$product->price}} KWD</p>
    </div>
    <div class="grayline"></div>
    <form >
        <div class="contnernotes">
            <input type="text" class="notes" placeholder="Add Instructions (Option)">
        </div>
        <div class="grayline"></div>
        <div class="contnernotes" style="place-items: center;">
            <input type="number" class="notes" value="1" style="width: 50px">
        </div>
    </form>
</main>


@stop

@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" class="orderbtn" value="Start Order"/>
    </div>
@stop
