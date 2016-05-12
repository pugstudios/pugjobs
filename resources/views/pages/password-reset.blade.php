<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Password Reset - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <h3>Reset Your Password</h3>

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
                    <input type="hidden" name="user_id" value="{{ $user -> id }}">
                    <div class="form-group">
                        <label for="password">Password <em>*</em></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password <em>*</em></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-default">Reset Password</button>&nbsp;
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>Tips on creating good passwords:</h3>
            <ul>
                <li>
                    <strong>Padding</strong>
                    <p>
                        The idea behind padding your password is to make it look bigger than it
                        actually is by adding extra characters to the end of your password to increase its length.
                    </p>
                    <ul>
                        <li><strong>Axis#47B</strong> becomes <strong>Axis#47B///////</strong></li>
                        <li><strong>Axis#47B</strong> becomes <strong>Axis#47B/\/\/\/\</strong></li>
                        <li><strong>Axis#47B</strong> becomes <strong>Axis#47B((()))</strong></li>
                    </ul>
                </li>
                <li>
                    <strong>Passphrases</strong>
                    <p>
                        Basically your password changes from a single word, to a phrase or a sentence.
                    </p>
                    <ul>
                        <li>I'm feeling a bit hungry</li>
                        <li>Purple Dragons In 9 Types of Mustard?</li>
                        <li>Radical Roses Outside Our Window</li>
                    </ul>
                </li>
                <li>
                    <strong>Formulas</strong>
                    <p>
                        The idea is to use a formula, system, or rule to assist you in creating and remember secure passwords.
                    </p>
                    <ul>
                        <li>
                            <strong>Talwsatgigasbasth</strong> is actually the first letter
                            of the line of the song "Stairway to Heaven": "There's a lady who's 
                            sure all that glitters is gold, and she's buying a stairway to heaven!"
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection