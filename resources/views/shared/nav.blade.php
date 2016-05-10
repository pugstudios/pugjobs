<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PugJobs.com</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(session('user'))
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-asterisk" aria-hidden="true"></i>&nbsp;&nbsp;Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a>{{ session('user') -> email }}</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Profile</a></li>
                        <li><a href="#"><i class="fa fa-th-list" aria-hidden="true"></i>&nbsp;&nbsp;Watch Lists</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('user/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Logout</a></li>
                    </ul>
                </li>
                @else
                <li><a href="{{ url('user/login') }}"><h4><span class="label label-primary">Login</span></h4></a></li>
                @endif


                <li><a href="{{ url('job/create') }}"><h4><span class="label label-danger">Post Job</span></h4></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>