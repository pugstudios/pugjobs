<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Your Posted Jobs')

@section('content')

@if (count($jobs) === 0)
<div class="alert alert-danger text-center" role="alert">There are currently no jobs to display.</div>
@else

<h2>Click on a job below to cancel or edit the posting.</h2>
<hr/>

@foreach($jobs as $job)

@include('shared.posting')

@endforeach
@endif

@endsection