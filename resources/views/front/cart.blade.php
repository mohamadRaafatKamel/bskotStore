
@extends('layouts.site')
@section('title', 'cart')

@section('toppage')
    <div class="topproducy">
        <h1>Review Order</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
    <div class="grayline"></div>
    <div class="sec-nav" style="display: block">
        <h1> Delivery Info </h1>
        <p>{{ $order->time }} minet</p>
    </div>
@stop

@section('main')
<main style="min-height: 500px;">
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



</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        <a href="{{ route('adress') }}">
            <input type="submit" class="orderbtn" value="check Out"/>
        </a>
    </div>
@stop
