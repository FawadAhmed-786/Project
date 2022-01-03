 <head>
    <meta charset="UTF-8" />
    <title>@yield('title') | goshtwala</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keyword" content="@yield('keyword')">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <!-- Favicon Link -->
    <link rel="shortcut icon" href="{{asset('assets/images/main-logo.png')}}" type="image/x-icon"/>

    <!-- CSS LINKS -->
    <link href="{{asset('assets/css/custom.css')}}"  rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/all.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/plugin.min.css')}}" rel="stylesheet" type="text/css">



    <!--------| script area |----------->
    <script type="text/javascript" src="{{asset('assets/js/plugin.min.js' )}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="{{asset( 'assets/js/pluginv.js' )}}"></script>
    <script type="text/javascript" src="{{asset( 'assets/js/pluginvam.min.js' )}}"></script>
  </head>