
@extends('layouts.site')
@section('title', __('msg.Thanks Page'))

@section('toppage')
    <div class="topproducy">
        <h1>{{ __('msg.check Out') }}</h1>
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
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <div class="paymentpage1">
                <i class="fa fa-check"></i>
                <h1>{{ __('msg.ThanksPage1') }}</h1>
                <p>{{ __('msg.ThanksPage2') }}</p>
            </div>

        </section>
        <!--Section: Main info-->
    </div>
</main>
@stop



@section('btnfooter')
    <a href="{{ route('home') }}">
        <div class="btnfooter">
            <input type="submit" value="{{ __('msg.Back') }} " class="orderbtn">
        </div>
    </a>

@stop



