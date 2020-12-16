
@extends('layouts.site')
@section('title', 'cart')

@section('toppage')
    <div class="topproducy">
        <h1>{{ __('msg.Review Order') }}</h1>
        @if(\Illuminate\Support\Facades\App::isLocale('en'))
            <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
        @endif
        @if(\Illuminate\Support\Facades\App::isLocale('ar'))
            <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-right" style="color: #000;"></i></a>
        @endif
    </div>

@stop

@section('main')
<main style="min-height: 500px;">

    <div class="grayline"></div>

    @if($empty == 1)
        <div class="paymentpage1">
            <i>
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
            </i>
            <br/><br/>
            <h1>{{ __('msg.emptyCart1') }}</h1>
            <p>{{ __('msg.emptyCart2') }}</p>
        </div>
    @endif

    @if($empty == 0)
    <div class="sec-nav" style="display: block">
        <h1> {{ __('msg.Delivery Info') }} </h1>
        <p>{{ $order->time }} {{ __('msg.day') }}</p>
    </div>
    <div class="grayline"></div>

    <div class="sec-nav" style="display: block">
        <h1>{{ __('msg.Order Items') }}</h1>
        @foreach($items as $item)
            <div id="d{{ $item ->id }}">
                <div class="price">
                    <p class="first"> {{\App\Models\Product::getNameById($item->pro_id)}} </p>
                    <p class="second">{{\App\Models\Product::getPriceById($item->pro_id)}} {{ __('msg.AED') }}</p>
                </div>
                <div class="price">
                    <div>
                        {{--    + and - Button    --}}
                        <div class="contnernotes pulse-minus" style="place-items: center;padding: 0px;margin-top: 0px;">
                            <button id="plusBtn" class="plusBtn" type="button" style="color: #000" value="{{$item->id}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                            <p id="numbr{{$item->id}}">{{$item->pro_amount}}</p>
                            <input type="hidden" name="pro_amount" id="proamount{{$item->id}}" value="{{$item->pro_amount}}">
                            <button id="minusBtn" class="minusBtn" type="button" style="color: #000" value="{{$item->id}}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-dash-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
{{--                    Remove Button--}}
                    <button type="button" id="{{ $item ->id }}" class="addcartbtn" style="width: auto;">{{ __('msg.Remove') }}</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grayline"></div>
        <div class=" price" style="display: -webkit-box;padding-right: 35px;margin-bottom: 10px;">
            <input type="text" id="promoCode" class="notes" name="promo_id" placeholder="{{ __('msg.Enter Code') }}"
                   @if($order->promo_id)value="{{ \App\Models\Orders::getCode($order->promo_id) }}" @endif
                   style="width: 70%">
            <button type="button" id="applyCode" class="applycodebtn">{{ __('msg.Apply') }}</button>
        </div>
        <div id="promoResult" style="text-align: center;color: #f7760e;"></div>
    <div class="grayline"></div>
    <div class="price">
        <p class="first">{{ __('msg.Total') }} : </p>
        <p class="second" id="totalCost">{{$order->total_cost}} {{ __('msg.AED') }}</p>
    </div>
    @endif


</main>
@stop

@section('btnfooter')

    @if($empty == 0)
    <div class="btnfooter">
        <a href="{{ route('adress') }}">
            <input type="submit" class="orderbtn" value="{{ __('msg.check Out') }}"/>
        </a>
    </div>
    @endif
@stop


@section('scripts')
    <script>
        $(document).ready(function() {

            // Apply promo Code
            $(document).on('click', '#applyCode', function (e) {
                e.preventDefault();
                let promoCode = $('#promoCode').val();
                $.ajax({
                    type: 'get',
                    url: "{{route('promo.code') }}" ,
                    data: { promocode : promoCode },
                    success: function (data) {
                        console.log(data);
                        // no order
                        if(data.order == 0){
                            $('#promoResult').empty().html("Code Not Valid");
                        }
                        // success
                        if (data.success) {
                            $('#promoResult').empty().html("Thank You code added");
                            $('#totalCost').empty().html(data.costItems +" AED");
                        }
                    }, error: function (reject) {
                        console.log(reject);
                    }
                });
            });

            // remove Button
            $(document).on('click', '.addcartbtn', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                //console.log(id);
                $.ajax({
                    type: 'get',
                    url: "{{route('remove.itemOrder') }}" ,
                    data: { id : id },
                    success: function (data) {
                        //console.log(data);
                        // no item
                        if(data.item == 0){
                            location.replace("{{ route('home') }}");
                        }
                        // success
                        if (data.success) {
                            $('#d'+id).empty().html("");
                            $('#totalCost').empty().html(data.costItems +" AED");
                        }
                    }, error: function (reject) {
                        //console.log(reject);
                    }
                });
            });

            // Plus Button
            $(".plusBtn").click(function(){
                var id = $(this).attr('value');
                //console.log(id);
                // for view
                var number = parseInt($("#proamount"+id).val());
                $("#proamount"+id).val(number + 1);
                $("#numbr"+id).html(number + 1);
                plusMinusBTN(id,'p');
            });

            // minus Button
            $(".minusBtn").click(function(){
                var id = $(this).attr('value');
                //console.log(id);
                // for view
                var number = parseInt($("#proamount"+id).val());
                if(number != 1){
                    $("#proamount"+id).val(number - 1);
                    $("#numbr"+id).html(number - 1);
                    plusMinusBTN(id,'m');
                }
            });

            function plusMinusBTN(id,type){
                $.ajax({
                    type: 'get',
                    url: "{{route('num.itemOrder') }}" ,
                    data: { id : id, type: type },
                    success: function (data) {
                        //console.log(data);
                        // no item
                        if(data.item == 0){
                            location.replace("{{ route('home') }}");
                        }
                        // success
                        if (data.success) {
                            $('#totalCost').empty().html(data.costItems +" AED");
                        }
                    }, error: function (reject) {
                        //console.log(reject);
                    }
                });
            }



        });

    </script>
@stop

<style>
.addcartbtn{
    border-radius: 4px;
    color: rgb(0, 0, 0);
    background-color: rgb(255, 255, 255);
    font-size: 13px;
    letter-spacing: -0.1px;
    line-height: 1.23;
    padding: 8px 16px;
    min-height: 32px;
    cursor: pointer;
    width: 100%;
    -webkit-box-align: center;
    align-items: center;
    position: relative;
    font-stretch: normal;
    font-style: normal;
    font-weight: 600;
    text-decoration: none;
    touch-action: manipulation;
    transition: all 0.2s ease-in 0s;
    border: 1px solid;
    user-select: none;
}
</style>

