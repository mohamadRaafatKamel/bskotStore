
@extends('layouts.site')
@section('title', 'Thanks Page')

@section('toppage')
    <div class="topproducy">
        <h1>Check out</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
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
            <div class="paymentpage1">
                <i class="fa fa-check"></i>
                <h1>Thank you for Payment</h1>
                <p>SMS massage send for your phone please conferm OTP code</p>
            </div>

        </section>
        <!--Section: Main info-->
    </div>
</main>
@stop



@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" value="Conferm OTP code" class="orderbtn">
    </div>

@stop



