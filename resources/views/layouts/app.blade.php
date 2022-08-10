<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Borneos Admin Management - Dari Borneos Untuk UKM Indonesia</title>

  <!-- Scripts -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{asset(env('PUBLIC_ASSETS').'css/base.min.css')}}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <script src="{{env('PUBLIC_ASSETS').'vendor/sweetalert/sweetalert.all.js'}}"></script>
</head>
<body>
  <div id="app">
    @include('sweetalert::alert')
    @yield('content')

    <div class="body-block-loading d-none">
        <div class="loader bg-transparent no-shadow p-0 align-center">
            <div class="ball-scale-multiple">
                <div style="background-color: rgb(253, 126, 20);"></div>
                <div style="background-color: rgb(253, 126, 20);"></div>
                <div style="background-color: rgb(253, 126, 20);"></div>
            </div>
        </div>
        <div style="z-index: 9999; padding-top: 2em; text-align: center; margin-left: -2.2em;"><span class="text-white">Loading...</span></div>
    </div>
  </div>
  </div>
  <!--Call package JS-->
  @include('layouts.app-js')
  <!--Call self function-->
  @yield('js')

  <script>
    $( document ).ready(function() {
      $.blockUI.defaults = {
          // timeout: 2000,
          fadeIn: 200,
          fadeOut: 400,
      };

      $('form').submit(function() {
        $.blockUI({message: $('.body-block-loading')});
      })
    })
  </script>
</body>
</html>
