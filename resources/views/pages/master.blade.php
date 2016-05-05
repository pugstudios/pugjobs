<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title')</title>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jasny-bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    </head>
    <body>
        @include('shared.nav')

        <div class="container">

            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('success') }}
            </div>
            @endif

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form id="job-search">
                        <div class="form-group">
                            <label class="sr-only" for="search">Search for jobs</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
                                <input type="text" class="form-control" id="search" placeholder="Search for jobs">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <hr/>

            @yield('content')

        </div>
        <br/>

        @include('shared.footer')

        <!-- JS -->
        <script src="{{ asset('js/jquery-1.12.3.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jasny-bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/summernote.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>