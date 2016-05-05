<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Create Account - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <h3>Join PugJobs.com - It's Free!</h3>

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class='well'>
                <p class='small'>Already have  PugJobs.com account? <a href='{{ url('user/login') }}'>Login Here</a></p>
                <form method='POST'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="email">Email <em>*</em></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="password">Password <em>*</em></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password <em>*</em></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                    </div>

                    <div class="form-group">
                        <p>Email me career-related updates and job opportunities.</p>
                        <div class="radio">
                            <label>
                                <input type="radio" name="newsletter" value="1" checked>Yes
                            </label>
                            &nbsp;
                            <label>
                                <input type="radio" name="newsletter" value="0">No
                            </label>
                        </div>
                    </div>

                    <p class='small'>By continuing you agree to PugJobs.com <a href='#'>Terms & Notices</a>, <a href='#'>Privacy & Security</a>, and the use of cookies.</p>
                    <button type="submit" class="btn btn-default">Create Account</button>&nbsp;
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Are You An Employer?</h3>
            <p>Registering as an employer with PugJobs.com will provide you the following benefits:</p>
            <ul>
                <li>Attract & engage the perfect talent</li>
                <li>Makes your first impression impressive</li>
                <li><strong>Post jobs for as little as $1</strong></li>
                <li>View who is looking at your and from where</li>
                <li>Employers can setup their accounts for <strong>FREE</strong>!
            </ul>
            <a href='{{ url('user/create') }}'><button type="button" class="btn btn-default btn-lg btn-block">Create A <strong>FREE</strong> Employer Account</button></a>
        </div>
    </div>
</div>

@endsection