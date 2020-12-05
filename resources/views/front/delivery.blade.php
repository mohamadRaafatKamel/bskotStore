
@extends('layouts.site')
@section('title', 'Delivery')

@section('toppage')
    <div class="topproducy">
        <h1>New Items</h1>
        <a href="{{route('home')}}" class="topproducyarrow"><i class="fas fa-arrow-left" style="color: #000;"></i></a>
    </div>
    <div class="mysearch">
        <input type="text" id="input-search" placeholder="Search"/>
    </div>
@stop
@section('main')
<main class="h-100">
    <div class="container">
    @include('admin.include.alerts.success')
    @include('admin.include.alerts.errors')
        <!--Section: Main info-->
        <section class="mt-5 wow fadeIn">
{{--            <div id="tree"></div>--}}
{{--            <div class="form-body">--}}

{{--            <div class="row">--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="projectinput2"> الاتجاة </label>--}}
{{--                        <select name="direction" class="select2 form-control">--}}
{{--                            <optgroup label="من فضلك أختر اتجاه اللغة ">--}}
{{--                                <option value="rtl">من اليمين الي اليسار</option>--}}
{{--                                <option value="ltr">من اليسار الي اليمين</option>--}}
{{--                            </optgroup>--}}
{{--                        </select>--}}
{{--                        @error('direction')--}}
{{--                        <span class="text-danger">{{$message}}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            </div>--}}




            <div class="row">
                <hr>
                <h2>Searchable Tree</h2>
                <div class="col-sm-4">
                    <h2>Input</h2>
                    <!-- <form> -->
                    <div class="form-group">
                        <label for="input-search" class="sr-only">Search Tree:</label>
                        <input type="input" class="form-control" id="input-search" placeholder="Type to search..." value="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox" id="chk-ignore-case" value="false">
                            Ignore Case
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox" id="chk-exact-match" value="false">
                            Exact Match
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="checkbox" id="chk-reveal-results" value="false">
                            Reveal Results
                        </label>
                    </div>
                    <button type="button" class="btn btn-success" id="btn-search">Search</button>
                    <button type="button" class="btn btn-default" id="btn-clear-search">Clear</button>
                    <!-- </form> -->
                </div>
                <div class="col-sm-4">
                    <h2>Tree</h2>
                    <div id="treeview-searchable" class=""></div>
                </div>
                <div class="col-sm-4">
                    <h2>Results</h2>
                    <div id="search-output"></div>
                </div>
            </div>














        </section>
        <!--Section: Main info-->

    </div>
</main>
@stop

@section('btnfooter')
    <div class="btnfooter">
        <input type="submit" class="orderbtn" value="Start Order"/>
    </div>
@stop
