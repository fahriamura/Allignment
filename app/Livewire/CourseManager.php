<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Course;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CourseManager extends Component
{
    use WithPagination, WithFileUploads;

    public $title, $description, $category, $video;
    public $editing_id;
    public $isEditing = false;  // Make sure this line is present

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'category' => 'required',
        'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
    ];

    public function render()
    {
        return view('livewire.course-manager', [
            'courses' => Course::latest()->paginate(10),
        ]);
    }

    // Add methods for create, edit, update, and delete operations
    public function create()
    {
        $this->validate();

        Course::create([
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
        ]);

        $this->reset(['title', 'description', 'category']);
        session()->flash('message', 'Course created successfully.');
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->editing_id = $id;
        $course = Course::findOrFail($id);
        $this->title = $course->title;
        $this->description = $course->description;
        $this->category = $course->category;
    }

    public function update()
    {
        $this->validate();

        $course = Course::findOrFail($this->editing_id);
        $course->update([
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
        ]);

        $this->isEditing = false;
        $this->reset(['title', 'description', 'category', 'editing_id']);
        session()->flash('message', 'Course updated successfully.');
    }

    public function delete($id)
    {
        Course::findOrFail($id)->delete();
        session()->flash('message', 'Course deleted successfully.');
    }
}
