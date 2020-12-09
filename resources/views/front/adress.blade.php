
@extends('layouts.site')
@section('title', 'Delivery Adress')

@section('toppage')
    <div class="topproducy">
        <h1>Check out</h1>
        <a href="{{route('cart')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
{{--    <div class="mysearch">--}}
{{--        <input type="text" id="input-search" placeholder="Search"/>--}}
{{--    </div>--}}
@stop
@section('main')
<main style="min-height: 500px;">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">

            <form method="post" action="{{ route('set.adress') }}">
                @csrf
                <div class="form-group">
                    <label for="Name">Add full adress</label>
                    <input type="text" name="delivery_adress" class="form-control" id="Name" placeholder="full adress" required>
                </div>


        </section>
        <!--Section: Main info-->

    </div>
</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" value="Next" class="orderbtn">
    </div>

    </form>
@stop
