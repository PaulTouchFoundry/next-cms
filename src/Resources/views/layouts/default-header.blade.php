{{-- Only yield content if ajax is requested --}}
@if (request()->ajax())
    @yield('content')
@else
<!doctype html>
<html class="l-html" lang="en">
    <head>
        @include('cms::includes.head')
    </head>

    <body>
        <!--[if lt IE 9]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/?locale=en">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        @include('cms::includes.header')

        <main class="main" role="main">
            @yield('content')
        </main>

        @include('cms::includes.foot')

        <!-- afterJS -->
        @yield('afterJS')
    </body>
</html>
@endif
