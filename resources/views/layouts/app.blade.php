<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title')</title>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}"/>
		<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}"/>

		<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}"/>

		<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

		<link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}"/>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    </head>
    <body >
        <header>
            @include('layouts.header')
        </header>
        <main>
            @yield('main')
        </main>
        
        <footer id="footer">
            @include('layouts.footer')
        </footer>
        <script src="{{asset('js/jquery.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slick.min.js')}}"></script>
        <script src="{{asset('js/nouislider.min.js')}}"></script>
        <script src="{{asset('js/jquery.zoom.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/ajax_script.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
