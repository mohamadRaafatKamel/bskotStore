
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
            <div class="paymentpage1" id="myDIV1" style="display: none">
                <h1>{{ __('msg.Not Found') }}</h1>
                <p>{{ __('msg.searchPage2') }}</p>
            </div>
            <div id="myDIV">
                @if($products)
                    <ul class="searchlist" id="ulContener">
                    @foreach($products as $product)
                        <li style="display: none" class="liproduct">
                            <a href="{{route('view',$product ->id)}}">
                                <div class="searchcontent">
                                    <h3 @if(\Illuminate\Support\Facades\App::isLocale('ar'))style="display: none"@endif>{{$product -> name_en}}</h3>
                                    <h4 @if(\Illuminate\Support\Facades\App::isLocale('ar'))style="display: none"@endif>{{$product -> notes_en}}</h4>
                                    <h3 @if(\Illuminate\Support\Facades\App::isLocale('en'))style="display: none"@endif>{{$product -> name_ar}}</h3>
                                    <h4 @if(\Illuminate\Support\Facades\App::isLocale('en'))style="display: none"@endif>{{$product -> notes_ar}}</h4>
                                    <button type="button" class="addcartbtn" style="width: auto">{{$product->price}} {{ __('msg.AED') }}</button>
                                </div>
                                <img src="{{ asset($product ->img) }}" class="img-fluid z-depth-1-half" alt="">
                            </a>
                        </li>
                    @endforeach
                    </ul>
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
                $("#myDIV li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                displayLayer();
            });

            function displayLayer(){
                var value = $('#anythingSearch').val();
                let numrelated = $('#ulContener > li:visible').length;
                console.log(numrelated);
                if(!value){
                    // init page
                    $('#myDIV0').css({"display": "flex"});
                    $('#myDIV1').css({"display": "none"});
                    $('.liproduct').css({"display": "none"});
                }else {
                    if ( numrelated == 0){
                        // no result
                        $('#myDIV0').css({"display": "none"});
                        $('#myDIV1').css({"display": "flex"});
                       // $('#myDIV').css({"display": "none"});
                    }else {
                        // have result
                        $('#myDIV0').css({"display": "none"});
                        $('#myDIV1').css({"display": "none"});
                        //$('#myDIV').css({"display": "block"});
                    }
                }
            }
        });
    </script>
@stop

