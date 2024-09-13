<div class="p-6 bg-white rounded-lg shadow-xl">
    <h2 class="text-2xl font-bold mb-4">{{ $isEditing ? 'Edit Zoom Course' : 'Create New Zoom Course' }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" id="title" wire:model="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="schedule" class="block text-gray-700 text-sm font-bold mb-2">Schedule:</label>
            <input type="datetime-local" id="schedule" wire:model="schedule" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('schedule') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="zoom_link" class="block text-gray-700 text-sm font-bold mb-2">Zoom Link:</label>
            <input type="url" id="zoom_link" wire:model="zoom_link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('zoom_link') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ $isEditing ? 'Update' : 'Create' }} Zoom Course
            </button>
            @if ($isEditing)
                <button type="button" wire:click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <div class="mt-8">
        <h3 class="text-xl font-bold mb-4">Zoom Course List</h3>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Schedule</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($zoomCourses as $zoomCourse)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $zoomCourse->title }}</td>
                        <td class="py-2 px-4 border-b">{{ $zoomCourse->schedule }}</td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="edit({{ $zoomCourse->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <button wire:click="delete({{ $zoomCourse->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this Zoom course?')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $zoomCourses->links() }}
        </div>
    </div>
</div>