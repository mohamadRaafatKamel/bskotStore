
@extends('layouts.site')
@section('title', 'Home Page')

@section('toppage')
    <!-- Navbar -->
    @include('front.include.header')
    <!-- Navbar -->
    @include('front.include.toppage')

    <div class="mysearch">
        <a href="search">
            <input type="text" placeholder="{{__('msg.Search')}}"/>
        </a>
    </div>
@stop
@section('main')
<main style="min-height: 500px;">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <!--Grid row-->
            <div class="row">
                @if($categories)
                    @foreach($categories as $category)
                        <div class="col-6 producthome">
                            <a href="{{route('product',$category ->id)}}">
                                <img src="{{ asset($category ->img) }}" class="img-fluid z-depth-1-half" alt="">
                                @if(\Illuminate\Support\Facades\App::isLocale('en'))
                                    <p>{{$category -> name_en}}</p>
                                @endif
                                @if(\Illuminate\Support\Facades\App::isLocale('ar'))
                                    <p>{{$category -> name_ar}}</p>
                                @endif
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
    @if($myitem)
        <a href="{{route('cart')}}" >
            <button type="button" class="orderbtn" style="display: flex">
                <span class="reviewbtn-item" id="reviewItem">{{ $myitem['allItems'] }}</span>
                <span class="reviewbtn-mid">{{ __('msg.Revieworder') }}</span>
                <span style="margin-left: auto;direction: rtl">
                    <span class="reviewbtn-cost" id="reviewCost"> {{ $myitem['costItems']." ". __('msg.AED') }} </span>
                </span>
            </button>
        </a>
    @else
        <a href="{{route('delivery')}}" >
            <input type="submit" class="orderbtn" value="{{ __('msg.StartOrder') }}"/>
        </a>
    @endif
    </div>
@stop

