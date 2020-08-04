<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('main/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('main/css/users.css') }}" rel="stylesheet">
    @stack('add_styles')
    <script src="{{ asset('main/js/app.js') }}" defer></script>
    @stack('add_scripts')
</head>
<body>
{{-- HEADER --}}
{{--@include('main.header')--}}

<div class="container no-padding">
    <div class="row no-gutters bg-white rounded shadow ow-h">

        {{-- ONLY MAIN PAGE --}}
s
        @yield('home_news')

        {{-- END --}}

        <main class="main col-md-9 px-3 py-4 border-right border-gray">
            @yield('content')
        </main>
        <aside class="aside col-md-3 px-3 py-4">
            @yield('aside')
        </aside>
    </div>
</div>

{{-- FOOTER --}}
{{--@include('main.footer')--}}

{{-- MODAL --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"></div>
</div>
@yield('scripts')
</body>
</html>