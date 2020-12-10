
@extends('layouts.site')
@section('title', 'OTP')

@section('toppage')
    <div class="topproducy">
        <h1>Order Look Up</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
{{--    <div class="mysearch">--}}
{{--        <input type="text" id="input-search" placeholder="Search"/>--}}
{{--    </div>--}}
    <div class="grayline"></div>
@stop
@section('main')
<main style="min-height: 500px;">

    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <div class="otppage1">
                <p>Order code can be found in SMS messages, after placing an order.</p>
            </div>
            <div class="contnernotes">
                <form action="{{ route('otpCheck') }}" method="post">
                    @csrf
                    <input type="text" class="notes" name="otp" placeholder="Order Code" required>

            </div>
        </section>
        <!--Section: Main info-->
        <div class="grayline"></div>
</main>
@stop



@section('btnfooter')
    @if(isset($_COOKIE['order']))
        <div class="btnfooter">
            <input type="submit" value="Conferm OTP code" class="orderbtn">
        </div>
        @endif
    </form>
@stop



