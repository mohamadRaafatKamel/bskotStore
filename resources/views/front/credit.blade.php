
@extends('layouts.site')
@section('title', 'Delivery Adress')

@section('toppage')
    <div class="topproducy">
        <h1>Check out</h1>
        <a href="{{route('cart')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
{{--    <div class="mysearch">--}}
{{--        <input type="text" id="input-search" placeholder="Search"/>--}}
{{--    </div>--}}
@stop
@section('main')
<main style="min-height: 500px;">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">

            <button type="button" id="creditBtn">credit</button>
            <button type="button" id="cashBtn">cash</button>

            <div id="showPayForm"></div>
        </section>
        <!--Section: Main info-->

    </div>
</main>
@stop



@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" value="Next" class="orderbtn">
    </div>

@stop



@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#creditBtn', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: "{{route('offers.checkout')}}",
                    data: {
                        price: '{{$isOrder -> total_cost}}',
                        offer_id: '{{$isOrder -> id}}',
                    },
                    success: function (data) {
                        //console.log(data);
                        if (data.status == true) {
                            $('#showPayForm').empty().html(data.content);
                        } else {
                        }
                    }, error: function (reject) {
                        //console.log(reject);
                    }
                });
            });
        });
    </script>
@stop
