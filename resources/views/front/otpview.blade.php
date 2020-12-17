
@extends('layouts.site')
@section('title', 'OTP')

@section('toppage')
    <div class="topproducy">
        <h1>{{ __('msg.Order Look Up') }}</h1>
        @if(\Illuminate\Support\Facades\App::isLocale('en'))
            <a href="{{route('cart')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
        @endif
        @if(\Illuminate\Support\Facades\App::isLocale('ar'))
            <a href="{{route('cart')}}" class="topproducyarrow"><i class="fas fa-arrow-right" style="color: #000;"></i></a>
        @endif
    </div>
    <div class="grayline"></div>
@stop
@section('main')
<main style="min-height: 500px;">

    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <div class="otppage1">
                <p>{{ __('msg.otpmessages') }}</p>
            </div>
            <div class="contnernotes">
                <form action="{{ route('otpCheck') }}" method="post">
                    @csrf
                    <input type="text" class="notes" name="otp" placeholder="{{ __('msg.OTP Code') }}" required>

            </div>
        </section>
        <!--Section: Main info-->
        <div class="grayline"></div>
</main>
@stop



@section('btnfooter')
    @if(isset($_COOKIE['order']))
        <div class="btnfooter">
            <input type="submit" value="{{ __('msg.confirm OTP code') }}" class="orderbtn">
        </div>
        @endif
    </form>
@stop



