<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Upload a video for the specified course.
     */
    public function uploadVideo(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'video' => 'required|mimetypes:video/mp4|max:20000',
        ]);

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('course_videos', 'public');
            $course->video_url = Storage::url($path);
            $course->save();
        }

        return redirect()->back()->with('success', 'Video uploaded successfully');
    }
}
