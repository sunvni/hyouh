<!doctype html>
<html>
<head>
    @include('layouts.partials.head')
</head>
<body>

    <header class="row">
        @include('layouts.partials.header')
    </header>

    <div id="main" class="container">
        <div class="row">
        <!-- sidebar content -->
         {{--<div id="sidebar" class="col-md-2">
           @include('layouts.partials.sidebar')
        </div>--}}

        <!-- main content -->
        <div id="content" class="col-md-10">
            @yield('content')
        </div>
        </div>
    </div>

    <footer class="row">
        @include('layouts.partials.footer')
    </footer>
</body>
</html>