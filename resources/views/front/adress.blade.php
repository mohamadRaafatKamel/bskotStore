
@extends('layouts.site')
@section('title', 'Delivery Adress')

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
@stop
@section('main')
<main style="min-height: 600px;">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">

            <form method="post" action="{{ route('set.adress') }}">
                @csrf

                <div class="form-group">
                    <label for="Name">{{ __('msg.Name') }}</label>
                    <input type="text" name="name" value="{{ $isOrder->name }}" class="form-control" id="Name" placeholder="{{ __('msg.Name') }}" required>
                </div>

                <div class="form-group">
                    <label for="Name">{{ __('msg.Phone') }}</label>
                    <input type="Phone" name="phone" value="{{ $isOrder->phone }}" class="form-control" id="Phone" placeholder="{{ __('msg.PhonePlaceholder') }}" required>
                </div>

                <div class="form-group">
                    <label for="Name">{{ __('msg.fulladress') }}</label>
                    <input type="text" name="delivery_adress" value="{{ $isOrder->delivery_adress }}" class="form-control" id="Name" placeholder="{{ __('msg.fulladress') }}" required>
                </div>




        </section>
        <!--Section: Main info-->

    </div>
</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" value="{{ __('msg.Next') }}" class="orderbtn">
    </div>

    </form>
@stop
