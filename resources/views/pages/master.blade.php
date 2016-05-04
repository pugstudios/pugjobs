
<html>
    <head>
        <title>@yield('title')</title>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    </head>
    <body>
        @include('shared.nav')

        <div class="container">
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
    </body>
</html>