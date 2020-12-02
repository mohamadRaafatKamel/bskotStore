<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bskot | @yield('title')</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="assets/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
@include('front.include.header')
<!-- Navbar -->

@include('front.include.toppage')

<div class="mysearch">
    <a href="search">
        <input type="text" placeholder="Search"/>
    </a>
</div>

<!--Main layout-->
@yield('main')
<!--Main layout-->

<div class="btnfooter">
    <input type="submit" class="orderbtn"/>
</div>
<!--Footer-->
@include('front.include.footer')
