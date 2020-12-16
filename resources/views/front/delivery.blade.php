
@extends('layouts.site')
@section('title', 'Delivery')

@section('toppage')
    <div class="topproducy">
        <h1>{{ __('msg.Order Mode') }}</h1>
        @if(\Illuminate\Support\Facades\App::isLocale('en'))
            <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
        @endif
        @if(\Illuminate\Support\Facades\App::isLocale('ar'))
            <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-right" style="color: #000;"></i></a>
        @endif
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

            <form method="post" action="{{ route('set.location') }}">
                @csrf
                <?php $selectValue = 0 ?>
                @if(!$myOrder)
                <div class="form-group">
                    <label for="Name">{{ __('msg.Name') }}</label>
                    <input type="text" name="name" class="form-control" id="Name" placeholder="{{ __('msg.Name') }}" required>
                </div>
                <div class="form-group">
                    <label for="Phone">{{ __('msg.Phone') }}</label>
                    <input type="Phone" name="phone" class="form-control" id="Phone" placeholder="{{ __('msg.PhonePlaceholder') }}" required>
                </div>
                @else
                    <?php $selectValue = $myOrder->area_id ?>
                @endif
                <div class="form-group">
                    <label for="Phone">{{ __('msg.Location') }}</label>
                    @if(\Illuminate\Support\Facades\App::isLocale('en'))
                    <select class="selectpicker form-control" name="area_id" data-live-search="true">
                        @foreach($data as $row)
                            <optgroup label="{{$row['emarhName']}}">
                            @foreach($row['areas'] as $area)
                                <option value="{{$area['id']}}" @if($area['id']== $selectValue)selected @endif>
                                    {{$area['name_en']}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @endif
                    @if(\Illuminate\Support\Facades\App::isLocale('ar'))
                        <select class="selectpicker form-control" name="area_id" data-live-search="true">
                            @foreach($data as $row)
                                <optgroup label="{{$row['emarhName_ar']}}">
                                    @foreach($row['areas'] as $area)
                                        <option value="{{$area['id']}}" @if($area['id']== $selectValue)selected @endif>
                                            {{$area['name_ar']}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    @endif
                </div>

        </section>
        <!--Section: Main info-->

    </div>
</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        @if(!isset($_COOKIE['order']))
            <input type="submit" value="{{ __('msg.Next') }}" class="orderbtn">
        @else
            <input type="submit" value="{{ __('msg.Edit') }}" class="orderbtn">
        @endif
    </div>

    </form>
@stop
