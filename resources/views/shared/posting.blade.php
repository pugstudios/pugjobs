
<div class="btn btn-large btn-block btn-default job-posting @if(Request::path() == 'job/posted') edit-job-posting @else view-job-posting @endif" id="job_post_{{ $job -> id }}">
    <div class="row">
        <div class="col-sm-2 logo-wrapper">
            @if(!empty($job -> company -> logo))
            <img src="{{ url('/imgs/logos/' . $job -> company -> logo) }}" alt="{{ $job -> company -> name }}" />
            @else
            <img src="{{ url('/imgs/logos/default_logo.png') }}" alt="{{ $job -> company -> name }}" />
            @endif
        </div>

        <div class="col-sm-7 text-left">
            <div class="row">
                <span class="job-title">{{ $job -> title }}</span>
            </div>
            <div class="row">
                <span class="company-name">{{ $job -> company -> name }}</span>
            </div>
        </div>

        <div class="col-sm-4 text-right">
            <div class="row">
                <span class="posted">{{ date('M d', strtotime($job -> created_at)) }}</span>
            </div>
            <div class="row">
                @if($job -> remote == 1)
                100% Remote
                @elseif($job -> remote == 2)
                {{ $job -> location }} (Partial Remote)
                @else
                {{ $job -> location }}
                @endif
            </div>
            <div class="row">
                @if(!empty($job -> salary))
                {{ $job -> salary }}
                @endif
            </div>
        </div>
    </div>
</div>