
@extends('layouts.site')
@section('title', 'Home Page')

@section('toppage')
    <!-- Navbar -->
    @include('front.include.header')
    <!-- Navbar -->
    @include('front.include.toppage')

    <div class="mysearch">
        <a href="search">
            <input type="text" placeholder="Search"/>
        </a>
    </div>
@stop
@section('main')
<main class="h-100">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <!--Grid row-->
            <div class="row">
                @if($categories)
                    @foreach($categories as $category)
                        <div class="col-6 producthome">
                            <a href="{{route('product',$category ->id)}}">
                                <img src="{{ asset($category ->img) }}" class="img-fluid z-depth-1-half" alt="">
                                <p>{{$category -> name_en}}</p>
                            </a>
                        </div>
                    @endforeach
                @endif


            </div>
            <!--Grid row-->
        </section>
        <!--Section: Main info-->



    </div>
</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" class="orderbtn" value="Start Order"/>
    </div>
@stop
