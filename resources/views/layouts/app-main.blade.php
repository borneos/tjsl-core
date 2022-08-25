<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TJSL Core - Content Management System</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />

    <!-- Styles -->
    <link href="{{ asset(env('PUBLIC_ASSETS') . 'css/base.min.css') }}" rel="stylesheet">
    <link href="{{ asset(env('PUBLIC_ASSETS') . 'css/tjsl.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="{{ env('PUBLIC_ASSETS') . 'vendor/sweetalert/sweetalert.all.js' }}"></script>
</head>

<body>
    <div id="app">
        @include('sweetalert::alert')
        <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <div class="w-100">
                        <img style="max-height: 3em" src="{{ env('PUBLIC_IMAGE') }}/images/logo.svg" />
                        <span style="font-weight: bold; color: #3f6ad8;">Admin</span>
                    </div>
                    <div class="header__pane ml-auto">
                        <div><button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar"><span class="hamburger-box"><span
                                        class="hamburger-inner"></span></span></button></div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <!-- START FOR RIGHT MENU MOBILE -->
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <img width="42" class="rounded-circle"
                                    src="https://ui-avatars.com/api/?name={{ Auth()->user()->f_name }}+{{ Auth()->user()->l_name }}&background=random"
                                    alt="">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="rm-pointers dropdown-menu-sm dropdown-menu dropdown-menu-right"
                                style="top: '10%' !important;">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-info">
                                        <div class="menu-header-image opacity-2"
                                            style="background-image: url(env('PUBLIC_ASSETS').'assets/images/dropdown-header/city3.jpg');">
                                        </div>
                                        <div class="menu-header-content text-left">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3"><img width="42"
                                                            class="rounded-circle"
                                                            src="https://ui-avatars.com/api/?name={{ Auth()->user()->f_name }}+{{ Auth()->user()->l_name }}&background=random"
                                                            alt=""></div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">Halo</div>
                                                        <div class="widget-subheading opacity-8">Nama</div>
                                                    </div>
                                                    <div class="widget-content-right mr-2"><a
                                                            href="{{ route('logout') }}"
                                                            class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END FOR RIGHT MENU MOBILE -->
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                class="p-0 btn">
                                                <img width="42" class="rounded-circle"
                                                    src="https://ui-avatars.com/api/?name={{ Auth()->user()->f_name }}+{{ Auth()->user()->l_name }}&background=random"
                                                    alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-info">
                                                        <!-- <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div> -->
                                                        <div class="menu-header-content text-left">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3"><img
                                                                            width="42" class="rounded-circle"
                                                                            src="https://ui-avatars.com/api/?name={{ Auth()->user()->f_name }}+{{ Auth()->user()->l_name }}&background=random"
                                                                            alt=""></div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading">Halo</div>
                                                                        <div class="widget-subheading opacity-8">Nama
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-right mr-2"><a
                                                                            href="{{ route('logout') }}"
                                                                            class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">Halo</div>
                                        <div class="widget-subheading">Nama</div>
                                    </div>
                                    <!-- <div class="widget-content-right header-user-info ml-3"><button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example"><i class="fa text-white fa-calendar pr-1 pl-1"></i></button></div> -->
                                </div>
                            </div>
                        </div>
                        <!-- <div class="header-btn-lg"><button type="button" class="hamburger hamburger--elastic open-right-drawer"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div> -->
                    </div>
                </div>
            </div>
            @yield('extend')
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div><button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                    data-class="closed-sidebar"><span class="hamburger-box"><span
                                            class="hamburger-inner"></span></span></button></div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div><button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"><span
                                    class="hamburger-box"><span class="hamburger-inner"></span></span></button></div>
                    </div>
                    <div class="app-header__menu"><span><button type="button"
                                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"><span
                                    class="btn-icon-wrapper"><i
                                        class="fa fa-ellipsis-v fa-w-6"></i></span></button></span></div>
                    <!-- SIDEBAR MENU START -->
                    @include('layouts.app-sidebar')
                    <!-- SIDEBAR MENU END -->
                </div>

                <div class="app-main__outer">
                    @yield('content')

                    <div class="body-block-loading d-none">
                        <div class="loader bg-transparent no-shadow p-0 align-center">
                            <div class="ball-scale-multiple">
                                <div style="background-color: rgb(253, 126, 20);"></div>
                                <div style="background-color: rgb(253, 126, 20);"></div>
                                <div style="background-color: rgb(253, 126, 20);"></div>
                            </div>
                        </div>
                        <div style="z-index: 9999; padding-top: 2em; text-align: center; margin-left: -2.2em;"><span
                                class="text-white">Loading...</span></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="app-drawer-overlay d-none animated fadeIn"></div>
    </div>
    <!--SCRIPTS INCLUDES-->
    <!--Call package JS-->
    @include('layouts.app-js')
    <!--Call self function-->
    @yield('js')

    <script>
        $(document).ready(function() {
            $.blockUI.defaults = {
                // timeout: 2000,
                fadeIn: 200,
                fadeOut: 400,
            };

            $('form').submit(function() {
                $.blockUI({
                    message: $('.body-block-loading')
                });
            })
        })

        function loading() {
            $.blockUI({
                message: $('.body-block-loading')
            });
        }
    </script>
</body>

</html>
