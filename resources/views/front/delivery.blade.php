
@extends('layouts.site')
@section('title', 'Delivery')

@section('toppage')
    <div class="topproducy">
        <h1>New Items</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
    <div class="mysearch">
        <input type="text" placeholder="Search"/>
    </div>
@stop
@section('main')
<main>
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">

            <div id="tree"></div>


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
