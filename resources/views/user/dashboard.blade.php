@extends('components.layouts.admin')

@section('content')
<div class="container">
    <h1>Welcome, {{ $user->name }}</h1>
    
    <h2>Your Video Courses</h2>
    @if($videoCourses->count() > 0)
        <ul>
            @foreach($videoCourses as $course)
                <li>{{ $course->title }}</li>
            @endforeach
        </ul>
    @else
        <p>No video courses available.</p>
    @endif

    <h2>Your Zoom Courses</h2>
    @if($zoomCourses->count() > 0)
        <ul>
            @foreach($zoomCourses as $course)
                <li>{{ $course->title }} - {{ $course->date }}</li>
            @endforeach
        </ul>
    @else
        <p>No Zoom courses available.</p>
    @endif
</div>
@endsection