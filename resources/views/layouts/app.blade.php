<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials._head')
<body>
    <div id="app">
        @include('partials._nav')
        <main class="py-4 container-fluid">
            @yield('content')
        </main>
        @include('partials._footer')
    </div>
    @include('partials._scripts')
@yield('scripts')
</body>
</html>
