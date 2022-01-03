 <head>
    <meta charset="UTF-8" />
    <title>@yield('title') | goshtwala</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keyword" content="@yield('keyword')">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="shortcut icon" href="{{asset('assets/images/main-logo.png')}}" type="image/x-icon"/>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/icheck-bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/datatable.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/custom2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/OverlayScrollbars.min.css')}}">
    <!--------| script area |----------->

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  </head>