
@extends('layouts.site')
@section('title', 'cart')

@section('toppage')
    <div class="topproducy">
        <h1>Review Order</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>

@stop

@section('main')
<main style="min-height: 500px;">

    <div class="grayline"></div>

    @if($empty = 1)
        <div class="paymentpage1">
            <i>
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
            </i>
            <br/><br/>
            <h1>Your bag is empty</h1>
            <p>Browse menu and add items to your order to proceed</p>
        </div>
    @endif

    @if($empty = 0)
    <div class="sec-nav" style="display: block">
        <h1> Delivery Info </h1>
        <p>{{ $order->time }} minet</p>
    </div>
    <div class="grayline"></div>

    <div class="sec-nav" style="display: block">
        <h1>Order Items</h1>
        @foreach($items as $item)
            <div>
                <div class="price">
                    <p class="first"> {{\App\Models\Product::getNameById($item->id)}} </p>
                    <p class="second">{{\App\Models\Product::getPriceById($item->id)}} KWD</p>
                </div>
                <div class="price">
                    <div>- {{$item->pro_amount}} + </div>
                    <button>remove</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grayline"></div>
    <div class="price">
        <p class="first">Total : </p>
        <p class="second">{{$order->total_cost}} KWD</p>
    </div>
    @endif


</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        <a href="{{ route('adress') }}">
            <input type="submit" class="orderbtn" value="check Out"/>
        </a>
    </div>
@stop
