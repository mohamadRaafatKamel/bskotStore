
@extends('layouts.site')
@section('title', 'view')

@section('toppage')
    <div class="topproducy">
        @if(\Illuminate\Support\Facades\App::isLocale('en'))
            <a href="{{route('product',$product->cat_id)}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
        @endif
        @if(\Illuminate\Support\Facades\App::isLocale('ar'))
            <a href="{{route('product',$product->cat_id)}}" class="topproducyarrow"><i class="fas fa-arrow-right" style="color: #000;"></i></a>
        @endif
    </div>
    <div class="view" style="background-image: url('{{asset($product->img)}}'); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Contenttop-nav-collapse -->
            <div class="text-center white-text mx-5 wow fadeIn">

                <!--Img-->
            </div>
            <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

    </div>
    <div class="sec-nav">
        <div>
            @if(\Illuminate\Support\Facades\App::isLocale('en'))
            <h1>{{$product->name_en}}</h1>
            <p>{{$product->notes_en}}</p>
            @endif
            @if(\Illuminate\Support\Facades\App::isLocale('ar'))
                    <h1>{{$product->name_ar}}</h1>
                    <p>{{$product->notes_ar}}</p>
            @endif
        </div>
    </div>
@stop
@section('main')
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')

<main>
    <div class="grayline"></div>
    <div class="price">
        <p class="first">{{ __('msg.Price') }} : </p>
        <p class="second">{{$product->price}} {{ __('msg.AED') }}</p>
        <input type="hidden" id="price" value="{{$product->price}}">
    </div>
    <div class="grayline"></div>
    <form method="post" action="{{ route('add.order',$product->id) }}">
        @csrf
        <div class="contnernotes">
            <input type="text" class="notes" name="notes" placeholder="{{ __('msg.Add Instructions') }}" @if($item)value="{{$item->notes}}" @endif >
        </div>
        <div class="grayline"></div>
        <div class="contnernotes pulse-minus" style="place-items: center;">
            <button id="plusBtn" type="button">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </button>
            @if($item)
                <p id="numbr">{{$item->pro_amount}}</p>
                <input type="hidden" name="pro_amount" id="proamount" value="{{$item->pro_amount}}">
            @else
                <p id="numbr">1</p>
                <input type="hidden" name="pro_amount" id="proamount" value="1">
            @endif
            <button id="minusBtn" type="button">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                </svg>
            </button>
        </div>

</main>


@stop

@section('btnfooter')
    <div class="btnfooter">
        @if($item)
            <input type="submit" class="orderbtn" id="orderbtn" value="{{ __('msg.Add to Order') }} . {{ __('msg.AED') }} {{$product->price * $item->pro_amount}}"/>
        @else
            <input type="submit" class="orderbtn" id="orderbtn" value="{{ __('msg.Add to Order') }} . {{ __('msg.AED') }} {{$product->price}}"/>
        @endif
    </div>

    </form>
@stop

@section('scripts')
    <script>
$(document).ready(function(){
    $("#plusBtn").click(function(){
        var number = parseInt($("#proamount").val());
        $("#proamount").val(number + 1);
        $("#numbr").html(number + 1);
        $("#orderbtn").val("{{ __('msg.Add to Order') }} . {{ __('msg.AED') }} " +parseInt($("#price").val())*(number + 1));
    });

    $("#minusBtn").click(function(){
        var number = parseInt($("#proamount").val());
        if(number != 1){
            $("#proamount").val(number - 1);
            $("#numbr").html(number - 1);
            $("#orderbtn").val("{{ __('msg.Add to Order') }} . {{ __('msg.AED') }} " +parseInt($("#price").val())*(number - 1));
        }
    });

});
    </script>

@stop
