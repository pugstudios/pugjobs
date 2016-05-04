<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'PugJobs.com')

@section('content')

@if (count($jobs) === 0)
    <div class="alert alert-danger text-center" role="alert">There are currently no jobs to display.</div>
@else
    There are jobs to show!
@endif

@endsection