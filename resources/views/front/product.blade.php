
@extends('layouts.site')
@section('title', 'Home Page')

@section('toppage')
    <div class="topproducy">
        <h1>New Items</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
@stop

@section('main')
<main>
    <div class="container">

        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <!--Grid row-->
            <div class="row">
                @if($products)
                    @foreach($products as $product)
                        <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                            <a href="{{route('view',$product ->id)}}">
                                <img src="{{ asset($product ->img) }}" class="img-fluid z-depth-1-half" alt="">
                                <p>{{$product -> name_en}}</p>
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
        <input type="submit" class="orderbtn"/>
    </div>
@stop
