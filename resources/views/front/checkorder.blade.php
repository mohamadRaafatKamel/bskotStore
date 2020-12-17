
@extends('layouts.site')
@section('title', __('msg.Check Order'))

@section('toppage')
    <div class="topproducy">
        <h1>{{ __('msg.Order Look Up2') }}</h1>
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
<main style="min-height: 600px;">

    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <div class="otppage1">
                <p>{{ __('msg.Check Order2') }}</p>
            </div>
            <div class="contnernotes">
                <form action="{{ route('check.order.p') }}" method="post">
                    @csrf
                    <input type="text" class="notes" name="id" placeholder="{{ __('msg.Order Code') }}" required>
            </div>
        </section>
        <!--Section: Main info-->
        <div class="grayline"></div>
</main>
@stop



@section('btnfooter')
    @if(isset($_COOKIE['order']))
        <div class="btnfooter">
            <input type="submit" value="{{ __('msg.check') }}" class="orderbtn">
        </div>
        @endif
    </form>
@stop



