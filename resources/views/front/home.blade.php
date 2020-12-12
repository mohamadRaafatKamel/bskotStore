
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
<main style="min-height: 500px;">
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
    @if(!isset($_COOKIE['order']))
        <div class="btnfooter">
            <a href="{{route('delivery')}}" >
                <input type="submit" class="orderbtn" value="{{__('startOrder0')}}" style="text-align:center;" />
            </a>
        </div>
    @else

    @endif

@stop
