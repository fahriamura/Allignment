<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ZoomCourse;
use Livewire\WithPagination;

class ZoomCourseManager extends Component
{
    use WithPagination;

    public $title, $schedule, $zoom_link;
    public $editing_id;
    public $isEditing = false;

    protected $rules = [
        'title' => 'required|min:3',
        'schedule' => 'required|date',
        'zoom_link' => 'required|url',
    ];

    public function render()
    {
        return view('livewire.zoom-course-manager', [
            'zoomCourses' => ZoomCourse::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        $this->validate();

        ZoomCourse::create([
            'title' => $this->title,
            'schedule' => $this->schedule,
            'zoom_link' => $this->zoom_link,
        ]);

        $this->reset(['title', 'schedule', 'zoom_link']);
        session()->flash('message', 'Zoom course created successfully.');
    }

    public function edit($id)
    {
        $zoomCourse = ZoomCourse::findOrFail($id);
        $this->editing_id = $id;
        $this->title = $zoomCourse->title;
        $this->schedule = $zoomCourse->schedule;
        $this->zoom_link = $zoomCourse->zoom_link;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $zoomCourse = ZoomCourse::findOrFail($this->editing_id);
        $zoomCourse->update([
            'title' => $this->title,
            'schedule' => $this->schedule,
            'zoom_link' => $this->zoom_link,
        ]);

        $this->reset(['title', 'schedule', 'zoom_link', 'editing_id', 'isEditing']);
        session()->flash('message', 'Zoom course updated successfully.');
    }

    public function delete($id)
    {
        ZoomCourse::findOrFail($id)->delete();
        session()->flash('message', 'Zoom course deleted successfully.');
    }

    public function cancel()
    {
        $this->reset(['title', 'schedule', 'zoom_link', 'editing_id', 'isEditing']);
    }
}