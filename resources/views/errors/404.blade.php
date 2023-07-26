
@extends('layouts.frontend')
@section('content')
<style>
.container-fluid .text-center h1,
.container-fluid .text-center a {
    animation: fadeIn 2s ease-in-out forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

    </style>

<div class="container-fluid" style="margin-top: 5px; margin-bottom: 5px;">
    <div class="text-center">
        <h1 class="text-primary" style="font-size: 102px; color: #ff6102; opacity: 0;">404</h1>
        <h2>Page Not Found</h2>
        <p class="lead">It looks like you found a glitch in the matrix...</p>
        <a href="{{ route('show') }}" class="btn btn-primary btn-lg" style="background-color: #151616; opacity: 0;">&larr; Back to Dashboard</a>
    </div>
</div>





           @endsection
