<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Create Company - PugJobs.com')

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
                <form method='POST' action="{{ url('user/create') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type" value="employer">
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

                    <hr/>

                    <div class="form-group">
                        <label for="name">Company Name <em>*</em></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="description">About Your Company</label>
                        <textarea name="description" class="summernote"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="logo">Company Logo</label><br/>
                        <small>Image will be cropped to 150x150. Choosing an image this size will ensure that your logo always displays great!</small>
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 150px; height: 150px;"></div>
                            <div>
                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="logo"></span>
                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <p>Email me employer-related updates and potential candidates.</p>
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
            <h3>Benefits of using PugJobs.com to hire your next rock-star:</h3>
            <ul>
                <li>Attract & engage the perfect talent</li>
                <li>Makes your first impression impressive</li>
                <li><strong>Post jobs for as little as ${{ env('PRICE_PER_DAY') }}</strong></li>
                <li>View who is looking at your and from where</li>
                <li>Employers can setup their accounts for <strong>FREE</strong>!
            </ul>
        </div>
    </div>
</div>

@endsection