<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Edit Job - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <h3>Edit Job Posting</h3>

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
                <form method='POST' action="{{ url('/job/edit/' . $job -> id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="employer_id" value="{{ Session::get('user') -> id }}">
                    <div class="form-group">
                        <label for="title">Job Title <em>*</em></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{ $job -> title }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Job Description <em>*</em></label>
                        <textarea name="description" class="summernote">{{ $job -> description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="remote">Remote Work Possibility <em>*</em></label>
                        <div class="radio">
                            <label>
                                <input class='job_create_remote_radio' type="radio" name="remote" value="1" @if($job -> remote == 1) checked @endif>100% Remote
                            </label>
                            <br/>
                            <label>
                                <input class='job_create_remote_radio' type="radio" name="remote" value="2" @if($job -> remote == 2) checked @endif>Remote Possible
                            </label>
                            <br/>
                            <label>
                                <input class='job_create_remote_radio' type="radio" name="remote" value="0" @if($job -> remote == 3) checked @endif>In Office Only
                            </label>
                        </div>
                    </div>

                    <div id="job_location_wrapper" class='@if($job -> remote == 1) hidden @endif form-group'>
                        <label class='job_create_location' for="location">Location <em>*</em></label>
                        <input type="string" class="form-control job_create_location" name="location" placeholder="i.e. city, state" value="{{ $job -> location }}">
                    </div>

                    <div class="form-group">
                        <label for="salary">Yearly Salary Range</label>
                        <select name="salary" class="form-control">
                            <option value="">- SELECT ONE -</option>
                            <option value="Less than $10,000" @if($job -> salary == 'Less than $10,000') selected @endif>Less than $10,000</option>
                            <option value="$10,000 - $20,000" @if($job -> salary == '$10,000 - $20,000') selected @endif>$10,000 - $20,000</option>
                            <option value="$20,000 - $30,000" @if($job -> salary == '$20,000 - $30,000') selected @endif>$20,000 - $30,000</option>
                            <option value="$30,000 - $40,000" @if($job -> salary == '$30,000 - $40,000') selected @endif>$30,000 - $40,000</option>
                            <option value="$40,000 - $50,000" @if($job -> salary == '$40,000 - $50,000') selected @endif>$40,000 - $50,000</option>
                            <option value="$50,000 - $60,000" @if($job -> salary == '$50,000 - $60,000') selected @endif>$50,000 - $60,000</option>
                            <option value="$60,000 - $70,000" @if($job -> salary == '$60,000 - $70,000') selected @endif>$60,000 - $70,000</option>
                            <option value="$70,000 - $80,000" @if($job -> salary == '$70,000 - $80,000') selected @endif>$70,000 - $80,000</option>
                            <option value="$80,000 - $90,000" @if($job -> salary == '$80,000 - $90,000') selected @endif>$80,000 - $90,000</option>
                            <option value="$90,000 - $100,000" @if($job -> salary == '$90,000 - $100,000') selected @endif>$90,000 - $100,000</option>
                            <option value="$100,000 +" @if($job -> salary == '$100,000 +') selected @endif>$100,000+</option>
                        </select>
                    </div>

                    <p class='small'>By continuing you agree to PugJobs.com <a href='#'>Terms & Notices</a>, <a href='#'>Privacy & Security</a>, and the use of cookies.</p>
                    <button type="submit" class="btn btn-default">Save Job Posting</button>&nbsp;
                </form>
            </div>
        </div>
        @include('shared.docs.how-to-write-a-great-job-post')
    </div>
</div>

@endsection