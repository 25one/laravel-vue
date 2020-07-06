<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Styles CSS -->
    <!-- app css (laravel) -->    
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <!-- bootstrap css again -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <!-- awesome css -->  
    <link rel="stylesheet" href="{{ asset('public/css/fontawesome.min.css') }}">  
    <!-- main.css (template) -->
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">

    @yield('css')

</head>
<body>
   <div id="app">
      @yield('main')
   </div>
<!-- Scripts JS -->   
<!-- app js (laravel) -->
<script src="{{ asset('public/js/app.js') }}"></script>
<!-- jquery scripts -->
<!-- 
<script src="js/jQuery-2.2.0.min.js"></script>
<script src="js/jquery-ui.min.js"></script>  
-->
<!-- <script src="js/main.js"></script> --> 
<!-- my mine.js -->
<!-- 
<script src="js/mine.js"></script>
-->

@yield('js') 

</body>
</html>
