@extends('layouts.admin')
@section('title','طلب')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.area')}}">  الطلبات </a>
                                </li>
                                <li class="breadcrumb-item active">طلب
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> طلب </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.include.alerts.success')
                                @include('admin.include.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات   </h4>

                                                <div class="row">
                                                    <table class="table display nowrap table-striped table-bordered ">
                                                        <tbody>
                                                            <tr>
                                                                <th>اسم العميل</th>
                                                                <th>{{$order -> name}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>الهاتف</th>
                                                                <th>{{$order -> phone}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>المنطقه</th>
                                                                <th>{{$order -> getAreaName($order -> area_id) }} </th>
                                                            </tr>
                                                            <tr>
                                                                <th>العنوان</th>
                                                                <th>{{$order -> delivery_adress}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>طريقه الدفع</th>
                                                                <th>{{$order -> getpaymentWay($order -> pay_way) }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>المبلغ الكلي</th>
                                                                <th>{{$order -> culcCostItem($order ->id)}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>المبلغ الدفوع</th>
                                                                <th>{{$order -> total_cost}}</th>
                                                            </tr>
                                                            @if($promoCode)
                                                            <tr>
                                                                <th>كود الخصم</th>
                                                                <th>{{ $promoCode ->code }}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>مقدار الخصم</th>
                                                                <th>{{ $promoCode ->value }} %</th>
                                                            </tr>
                                                            @endif
                                                            <tr>
                                                                <th>التاريخ</th>
                                                                <th>{{$order -> updated_at}}</th>
                                                            </tr>
                                                            <tr>
                                                                <th>الحاله</th>
                                                                <th>{{$order -> getOrderState($order->state)}}</th>
                                                            </tr>
                                                            <tr style="color: red">
                                                                <th>محتوي الطلب</th>
                                                                <th>العدد</th>
                                                            </tr>
                                                            @if($items)
                                                                @foreach($items as $item)
                                                                    <tr>
                                                                        <th>{{ \App\Models\Product::getNameById($item->pro_id) }}</th>
                                                                        <th>عدد {{ $item->pro_amount }}</th>
                                                                    </tr>
                                                                @endforeach
                                                            @endif

                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <a href="{{ route('admin.order.view.sending',$order ->id) }}">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> ارسال الطلب
                                                </button>
                                                </a>
                                                <a href="{{ route('admin.order.view.done',$order ->id) }}">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i>  تم تسليم الطلب
                                                    </button>
                                                </a>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
