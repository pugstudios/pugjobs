<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Forgot Password - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <h3>Forgot Password?</h3>

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
                <form method='POST'>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-default">Send Password Reset Link</button>&nbsp;
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>How To Reset Your Password:</h3>
            <p>
                Forgot your password? Don't worry...it happens to the best of us. We will send a link 
                to your <strong>registered</strong> email address that will allow you to reset your
                password. Easy peasy!
            </p>
            <p>
                If you don't receive an email from us within the next 30 minutes, please check your 
                "Spam" or "Junk" email folders.
            </p>
        </div>
    </div>
</div>

@endsection