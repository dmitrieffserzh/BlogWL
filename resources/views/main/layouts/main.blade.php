<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title') | {{  __('main.title') }}
    </title>
@section('description', __('main.title'))

<!-- STYLES -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
<header class="header">
    <div class="container">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" viewBox="0 0 40.1 40">
                <polygon fill="#000" points="0,0 0,40 10.1,30 20.1,40 30.1,30 "/>
                <polygon fill="#FF0849" points="40.1,0 40.1,40 20.1,20 "/>
            </svg>
        </div>
        <nav class="main-menu">
            <ul class="main-menu__list">
                <li class="main-menu__item"><a href="">Главная</a></li>
                <li class="main-menu__item"><a href="{{ route('blog') }}">Блог</a></li>
                <li class="main-menu__item"><a href="">Мои работы</a></li>
                <li class="main-menu__item"><a href="">О мне :)</a></li>
            </ul>
        </nav>
    </div>
</header>
<main class="main">
    <div class="container">
        @yield('content')
    </div>
</main>
<footer class="footer">
    <div class="container">
        <div class="copyright">
            <p>@lang('main.copyright')</p>
        </div>
    </div>
</footer>
@stack('scripts')














<!---
<header class="header">
    <div class="container">
        @if(Route::currentRouteName() == 'main')
            <div class="header__logo" onclick="window.location.reload();">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" viewBox="0 0 40.1 40">
                        <polygon fill="#000" points="0,0 0,40 10.1,30 20.1,40 30.1,30 "/>
                        <polygon fill="#FF0849" points="40.1,0 40.1,40 20.1,20 "/>
                    </svg>
            </div>
        @else
            <a class="header__logo" href="{{ url('/') }}" title="@lang('main.title')">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="40" viewBox="0 0 40.1 40">
                    <polygon fill="#000" points="0,0 0,40 10.1,30 20.1,40 30.1,30 "/>
                    <polygon fill="#FF0849" points="40.1,0 40.1,40 20.1,20 "/>
                </svg>
            </a>
        @endif
        @include('main.components.menu-main')
        {{--@include('components.menu-auth')--}}
    </div>
</header>

<main class="main content">
    <section class="section ">
        @yield('content')
    </section>

    <aside class="aside">
        SIDEBAR
    </aside>
</main>


<footer class="footer">
    <div class="container">
        FOOTER
    </div>
    <div class="footer-copy">
        <p>@lang('main.copyright')</p>
    </div>
</footer>
<div class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"></div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
-->
</body>
</html>