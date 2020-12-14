
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
    <div class="grayline"></div>
@stop
@section('main')
<main style="min-height: 500px;">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
            <div class="paymentpage1">
                <i role="presentation" aria-hidden="true" class="ltr-11rqj0r e1i5aqxk0">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                    </svg>
                </i>
                <h1>Payment Method</h1>

            </div>
            <div class="paymentpage2">
{{--                <button type="button" id="creditBtn">Credit Card</button>--}}
                <button type="button" id="cashBtn">cash</button>
            </div>

            <div>
                <div id="showPayForm"></div>

                @if(isset($paymentMessage))
                    @if($paymentMessage)
                        <div class="alert alert-success text-center">
                            تم الدفع بنجاح
                        </div>
                    @else
                        <div class="alert alert-danger text-center">
                            فشلت عملية الدفع
                        </div>
                    @endif
                @endif
            </div>
        </section>
        <!--Section: Main info-->

    </div>
</main>
@stop



@section('btnfooter')
{{--    <div class="btnfooter">--}}
{{--        <input type="submit" value="Next" class="orderbtn">--}}
{{--    </div>--}}

@stop



@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#cashBtn', function (e) {
                e.preventDefault();
                location.replace("{{ route('cash') }}");
            });
        });
        /*
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
        */
    </script>
@stop
