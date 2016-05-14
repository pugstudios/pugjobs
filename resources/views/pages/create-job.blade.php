<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Create Job - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">
            <h3>Posting a job costs only ${{ env('PRICE_PER_DAY') }} per day that you have it active.</h3>

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
                <form method='POST' action="{{ url('/payment') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="employer_id" value="{{ Session::get('user') -> id }}">
                    <div class="form-group">
                        <label for="title">Job Title <em>*</em></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="description">Job Description <em>*</em></label>
                        <textarea name="description" class="summernote"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="remote">Remote Work Possibility <em>*</em></label>
                        <div class="radio">
                            <label>
                                <input class='job_create_remote_radio' type="radio" name="remote" value="1">100% Remote
                            </label>
                            <br/>
                            <label>
                                <input class='job_create_remote_radio' type="radio" name="remote" value="2">Remote Possible
                            </label>
                            <br/>
                            <label>
                                <input class='job_create_remote_radio' type="radio" name="remote" value="0" checked>In Office Only
                            </label>
                        </div>
                    </div>

                    <div id="job_location_wrapper" class="form-group">
                        <label class='job_create_location' for="location">Location <em>*</em></label>
                        <input type="string" class="form-control job_create_location" name="location" placeholder="i.e. city, state">
                    </div>


                    <div id="job_location_wrapper" class="form-group">
                        <label for="daterange">Posting Range <em>*</em></label>
                        <input type="string" class="form-control" name="daterange" value="" />
                        <p class='small'>
                            It only costs <strong>${{ env('PRICE_PER_DAY') }}</strong> per day to have your job posted. You can close your posting at any time and 
                            you will be refunded the amount not used.
                        </p>

                    </div>

                    <div class="form-group">
                        <label for="salary">Yearly Salary Range</label>
                        <select name="salary" class="form-control">
                            <option value="">- SELECT ONE -</option>
                            <option value="Less than $10,000">Less than $10,000</option>
                            <option value="$10,000 - $20,000">$10,000 - $20,000</option>
                            <option value="$20,000 - $30,000">$20,000 - $30,000</option>
                            <option value="$30,000 - $40,000">$30,000 - $40,000</option>
                            <option value="$40,000 - $50,000">$40,000 - $50,000</option>
                            <option value="$50,000 - $60,000">$50,000 - $60,000</option>
                            <option value="$60,000 - $70,000">$60,000 - $70,000</option>
                            <option value="$70,000 - $80,000">$70,000 - $80,000</option>
                            <option value="$80,000 - $90,000">$80,000 - $90,000</option>
                            <option value="$90,000 - $100,000">$90,000 - $100,000</option>
                            <option value="$100,000 +">$100,000+</option>
                        </select>
                    </div>

                    <p class='small'>By continuing you agree to PugJobs.com <a href='#'>Terms & Notices</a>, <a href='#'>Privacy & Security</a>, and the use of cookies.</p>
                    <button type="submit" class="btn btn-default">Continue To Payment</button>&nbsp;
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>How to write a great job post:</h3>
            <ul>
                <li>
                    <strong>Title</strong>
                    <p>Give your job post a title that sets it apart from others. Try to mention the language or technologies the job requires.</p>
                </li>
                <li>
                    <strong>Description</strong>
                    <p>Try to answer the following questions in your job description:</p>
                    <ul>
                        <li>What is the position all about?</li>
                        <li>What are the intriguing aspects to the position?</li>
                        <li>What will the candidate be responsible for?</li>
                        <li>Will the candidate work with a great team or use some new tools?</li>
                        <li>What is a list of skills that make sense considering the skill level of the candidate?</li>
                        <li>What skills are mandatory?</li>
                        <li>If there are secondary skills that you'd like candidates to have or to learn, how important are they?</li>
                    </ul>
                </li>
                <li>
                    <strong>Salary</strong>
                    <p>
                        Even though it's not required, job seekers often only apply for jobs that are within their salary range. This saves both the 
                        job seeker and the job poster from spending time on jobs that won't work for them.
                    </p>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection