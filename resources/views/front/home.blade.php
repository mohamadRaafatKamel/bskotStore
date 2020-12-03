
@extends('layouts.site')
@section('title', 'Home Page')

@section('main')
<main>
    <div class="container">

        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <!--Grid row-->
            <div class="row">
                @if($categories)
                    @foreach($categories as $category)
                        <div class="col-md-6 col-xs-6 col-sm-6 col-lg-6">
                            <a href="#">
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
        <input type="submit" class="orderbtn"/>
    </div>
@stop
