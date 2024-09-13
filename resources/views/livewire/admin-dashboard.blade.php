<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
      .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1000; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal content centered */
.modal .modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fefefe;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 500px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  border-radius: 10px;
}

    </style>
  </head>
<body>

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="flex flex-col h-0 flex-1 bg-gray-800">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <img src="{{ asset('asset/images/logo3.png') }}" alt="Logo">
                        </div>
                        <nav class="mt-5 flex-1 px-2 space-y-1">
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $currentSection === 'dashboard' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" wire:click.prevent="showSection('dashboard')">Dashboard</a>
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $currentSection === 'categories' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" wire:click.prevent="showSection('categories')">Categories</a>
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $currentSection === 'videos' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" wire:click.prevent="showSection('videos')">Videos</a>
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $currentSection === 'zoom-courses' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" wire:click.prevent="showSection('zoom-courses')">Zoom Courses</a>
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $currentSection === 'subscriptions' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" wire:click.prevent="showSection('subscriptions')">Subscriptions</a>
                            <a href="#" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $currentSection === 'users' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" wire:click.prevent="showSection('users')">Users</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    <!-- Main content -->
    
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">{{ ucfirst($currentSection) }}</h1>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <!-- Content sections -->
                    @if($currentSection === 'dashboard')
                            <div class="py-4">
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Welcome to the CMS Dashboard</h3>
                                        <div class="mt-2 max-w-xl text-sm text-gray-500">
                                            <p>Select a section from the sidebar to manage your content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($currentSection === 'categories')
                            <div class="py-4">
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Category Management</h3>
                                        <div class="mt-2 max-w-xl text-sm text-gray-500">
                                            <p>Manage your categories here.</p>
                                        </div>
                                        <div class="mt-5">
                                            <button wire:click="openDialog('Category')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Add New Category
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($currentSection === 'videos')
                        <div class="py-4" >
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Video Management</h3>
                                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                                        <p>Manage your videos here.</p>
                                    </div>
                                    <div class="mt-5">
                                        <button wire:click="openDialog('Video')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Add New Video
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($currentSection === 'zoom-courses')
                        <div id="zoom-courses" class="py-4" x-show="$wire.currentSection === 'zoom-courses'">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Zoom Course Management</h3>
                                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                                        <p>Manage your Zoom courses here.</p>
                                    </div>
                                    <div class="mt-5">
                                        <button wire:click="openDialog('ZoomCourse')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Add New Zoom Course
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($currentSection === 'subscription')
                        <div id="subscriptions" class="py-4" x-show="$wire.currentSection === 'subscriptions'">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Subscription Management</h3>
                                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                                        <p>Manage your subscriptions here.</p>
                                    </div>
                                    <div class="mt-5">
                                        <button wire:click="openDialog('Subscription')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Add New Subscription
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif($currentSection === 'users')
                        <div id="users" class="py-4" x-show="$wire.currentSection === 'users'">
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">User Management</h3>
                                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                                        <p>Manage users here.</p>
                                    </div>
                                    <div class="mt-5">
                                        <button wire:click="openDialog('User')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Add New User
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Dialogs -->
    @if($showCategoryDialog)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity flex items-center justify-center z-50">
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New Category</h3>
                <form wire:submit.prevent="addCategory">
                    <div class="mt-2">
                        <div>
                            <label for="category-name" class="block text-sm font-medium text-gray-700">Category Name</label>
                            <input type="text" wire:model="categoryName" id="category-name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="category-type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select wire:model="categoryType" id="category-type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                                <option value="platinum">Platinum</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-5 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <button type="button" wire:click="closeDialog('Category')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-1 sm:text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if($showVideoDialog)
    @include('partials.video-dialog')
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity flex items-center justify-center z-50">
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New Video</h3>
                <form wire:submit.prevent="addVideo">
                    <div class="mt-2">
                        <div>
                            <label for="video-title" class="block text-sm font-medium text-gray-700">Video Title</label>
                            <input type="text" wire:model="videoTitle" id="video-title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="video-url" class="block text-sm font-medium text-gray-700">Video URL</label>
                            <input type="url" wire:model="videoUrl" id="video-url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-5 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <button type="button" wire:click="closeDialog('Video')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-1 sm:text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if($showZoomCourseDialog)
    @include('partials.zoom-course-dialog')
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity flex items-center justify-center z-50">
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New Zoom Course</h3>
                <form wire:submit.prevent="addZoomCourse">
                    <div class="mt-2">
                        <div>
                            <label for="zoom-topic" class="block text-sm font-medium text-gray-700">Zoom Topic</label>
                            <input type="text" wire:model="zoomTopic" id="zoom-topic" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="zoom-date" class="block text-sm font-medium text-gray-700">Zoom Date</label>
                            <input type="date" wire:model="zoomDate" id="zoom-date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="zoom-time" class="block text-sm font-medium text-gray-700">Zoom Time</label>
                            <input type="time" wire:model="zoomTime" id="zoom-time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-5 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <button type="button" wire:click="closeDialog('ZoomCourse')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-1 sm:text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if($showSubscriptionDialog)
    @include('partials.subscription-dialog')
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity flex items-center justify-center z-50">
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New Subscription</h3>
                <form wire:submit.prevent="addSubscription">
                    <div class="mt-2">
                        <div>
                            <label for="subscription-name" class="block text-sm font-medium text-gray-700">Subscription Name</label>
                            <input type="text" wire:model="subscriptionName" id="subscription-name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="subscription-price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" wire:model="subscriptionPrice" id="subscription-price" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="subscription-duration" class="block text-sm font-medium text-gray-700">Duration</label>
                            <select wire:model="subscriptionDuration" id="subscription-duration" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-5 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <button type="button" wire:click="closeDialog('Subscription')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-1 sm:text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if($showUserDialog)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity flex items-center justify-center z-50">
        <div class="bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add New User</h3>
                <form wire:submit.prevent="addUser">
                    <div class="mt-2">
                        <div>
                            <label for="user-name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" wire:model="userName" id="user-name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="user-email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="userEmail" id="user-email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mt-4">
                            <label for="user-subscription" class="block text-sm font-medium text-gray-700">Subscription</label>
                            <select wire:model="userSubscription" id="user-subscription" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="silver">Silver</option>
                                <option value="gold">Gold</option>
                                <option value="platinum">Platinum</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-5 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        <button type="button" wire:click="closeDialog('User')" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-1 sm:text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:col-start-2 sm:text-sm">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
</body>
</html>