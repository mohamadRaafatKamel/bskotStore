
@extends('layouts.site')
@section('title', 'Home Page')

@section('toppage')
    <div class="topproducy">
        @if(\Illuminate\Support\Facades\App::isLocale('en'))
            <h1>{{ $category->name_en }}</h1>
            <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
        @endif
        @if(\Illuminate\Support\Facades\App::isLocale('ar'))
            <h1>{{ $category->name_ar }}</h1>
            <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-right" style="color: #000;"></i></a>
        @endif
    </div>
@stop

@section('main')
<main style="min-height: 500px;">
    <div class="container">

        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <!--Grid row-->
            <div class="row">
                @if($products)
                    @foreach($products as $product)
                        <div class="col-6" style="padding: 8px 8px 32px;">
                            <a href="{{route('view',$product ->id)}}">
                                <img src="{{ asset($product ->img) }}" class="img-fluid z-depth-1-half" alt="">
                                <div style="display: flex;">
                                    @if(\Illuminate\Support\Facades\App::isLocale('en'))
                                        <span class="productcount" id="s{{ $product ->id }}">
                                            @if(isset($myitem[$product ->id]))
                                                &nbsp;{{ $myitem[$product ->id] }}<span>x</span>
                                            @endif
                                        </span>
                                        <p style="font-size: 13px;font-weight: 500;letter-spacing: -0.1px;">{{$product -> name_en}}</p>
                                    @endif
                                    @if(\Illuminate\Support\Facades\App::isLocale('ar'))
                                        <span class="productcount" id="s{{ $product ->id }}">
                                            @if(isset($myitem[$product ->id]))
                                                 <span>x</span>{{ $myitem[$product ->id] }}&nbsp;
                                             @endif
                                        </span>
                                        <p style="font-size: 13px;font-weight: 500;letter-spacing: -0.1px;">{{$product -> name_ar}}</p>
                                    @endif
                                </div>
                                <button type="button" class="addcartbtn" id="{{ $product ->id }}" >{{$product->price}} {{ __('msg.AED') }}</button>
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
                        <span class="reviewbtn-cost" id="reviewCost"> {{ $myitem['costItems'] }} {{ __('msg.AED') }}</span>
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


@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.addcartbtn', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');
                //console.log(id);
                $.ajax({
                    type: 'get',
                    url: "{{route('add.order.ajax') }}" ,
                    data: {
                        id : id ,
                        pro_amount: 1 ,
                        notes: null ,
                    },
                    success: function (data) {
                        //console.log(data);
                        // no cookies
                        if(data.cookies == 0){
                            location.replace("{{ route('delivery') }}?id="+id);
                        }
                        // no product
                        if(data.product == 0){
                            location.replace("{{ route('home') }}");
                        }
                        // scsses
                        if (data.success) {
                            @if(\Illuminate\Support\Facades\App::isLocale('en'))
                            $('#s'+id).empty().html(data.success+"x ");
                            @endif
                            @if(\Illuminate\Support\Facades\App::isLocale('ar'))
                            $('#s'+id).empty().html(" x"+data.success);
                            @endif
                            $('#reviewItem').empty().html(data.allItems);
                            $('#reviewCost').empty().html(data.costItems +" {{ __('msg.AED') }}");
                        }
                    }, error: function (reject) {
                        //console.log(reject);
                    }
                });
            });
        });

        {{--$(document).ready(function() {--}}
        {{--    $(document).on('click', '.addcartbtn', function (e) {--}}
        {{--        e.preventDefault();--}}
        {{--        $.ajax({--}}
        {{--            type: 'get',--}}
        {{--            url: "{{route('offers.checkout')}}",--}}
        {{--            data: {--}}
        {{--                price: '{{$isOrder -> total_cost}}',--}}
        {{--                offer_id: '{{$isOrder -> id}}',--}}
        {{--            },--}}
        {{--            success: function (data) {--}}
        {{--                //console.log(data);--}}
        {{--                if (data.status == true) {--}}
        {{--                    $('#showPayForm').empty().html(data.content);--}}
        {{--                } else {--}}
        {{--                }--}}
        {{--            }, error: function (reject) {--}}
        {{--                //console.log(reject);--}}
        {{--            }--}}
        {{--        });--}}
        {{--    });--}}
        {{--});--}}

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

