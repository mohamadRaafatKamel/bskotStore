
@extends('layouts.site')
@section('title', __('msg.Search'))

@section('toppage')
<style>
    .cancel-link{
        font-size: 15px;
        font-weight: 400;
        line-height: 1.33;
        letter-spacing: -0.2px;
        overflow-wrap: break-word;
        word-break: break-word;
        border: none;
        display: inline;
        background: transparent;
        cursor: pointer;
        appearance: none;
        text-decoration: none;
        touch-action: manipulation;
        transition: all 0.2s ease-in 0s;
        padding: 0px;
        margin-left: 16px;
        color: rgb(228, 106, 8);
    }
    .cancel-link:hover{
        color: rgb(228, 106, 8);
    }
</style>
    <div class="mysearch">
        <div class="row">
            <div class="col-10">
                <input type="text" id="anythingSearch" placeholder="{{__('msg.Search')}}"/>
            </div>
            <div class="cal-2">
                <a class="cancel-link" href="{{ route('home') }}">{{ __('msg.Cancel') }}</a>
            </div>
        </div>


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

            <div class="paymentpage1" id="myDIV0">
                <h1>{{ __('msg.Find products') }}</h1>
                <p>{{ __('msg.searchPage2') }}</p>
            </div>

            <div class="row" id="myDIV" style="display: none">
                @if($products)
                    @foreach($products as $product)
                        <div class="col-6 producthome" style="padding: 8px 8px 32px;">
                            <a href="{{route('view',$product ->id)}}">
                                <img src="{{ asset($product ->img) }}" class="img-fluid z-depth-1-half" alt="">
                                <p style="font-size: 13px;font-weight: 500;letter-spacing: -0.1px; @if(! \Illuminate\Support\Facades\App::isLocale('en')) display: none @endif ">
                                    {{$product -> name_en}}</p>
                                <p style="font-size: 13px;font-weight: 500;letter-spacing: -0.1px; @if(! \Illuminate\Support\Facades\App::isLocale('ar')) display: none @endif ">
                                    {{$product -> name_ar}}</p>
                                <p style="font-size: 13px;font-weight: 500;letter-spacing: -0.1px;">{{$product->price}} {{ __('msg.AED') }}</p>
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

@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#anythingSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                console.log(value);
                if(!value){
                    $('#myDIV0').css({"display": "initial"});
                    $('#myDIV').css({"display": "none"});
                }else {
                    $('#myDIV0').css({"display": "none"});
                    $('#myDIV').css({"display": "initial"});
                }
                $("#myDIV .producthome").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@stop

