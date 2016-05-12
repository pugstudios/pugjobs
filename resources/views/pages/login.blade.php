<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Login - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <h3>Login</h3>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            @if (Session::has('invalid-credentials'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('invalid-credentials') }}</li>
                </ul>
            </div>
            @endif

            <div class='well'>
                <form method='POST'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-default">Secure Login</button>&nbsp;
                    <a href='{{ url('user/password') }}'>Forgot Password?</a>
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Create Account</h3>
            <p>Register with PugJobs.com to enjoy personalized services including:</p>
            <ul>
                <li>Narrowed job searches</li>
                <li>Email notifications</li>
                <li>Employers can post jobs for as little as ${{ env('PRICE_PER_DAY') }}</li>
                <li>Statistics in both posting and searching jobs</li>
            </ul>
            <a href='{{ url('user/create') }}'><button type="button" class="btn btn-default btn-lg btn-block">Create An Account</button></a>
        </div>
    </div>
</div>

@endsection