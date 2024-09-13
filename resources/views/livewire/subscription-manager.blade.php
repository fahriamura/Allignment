<div class="p-6 bg-white rounded-lg shadow-xl">
    <h2 class="text-2xl font-bold mb-4">{{ $isEditing ? 'Edit Subscription' : 'Create New Subscription' }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
        <div class="mb-4">
            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User:</label>
            <select id="user_id" wire:model="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">Select a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="plan_name" class="block text-gray-700 text-sm font-bold mb-2">Plan Name:</label>
            <input type="text" id="plan_name" wire:model="plan_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('plan_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
            <input type="number" step="0.01" id="price" wire:model="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="started_at" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            <input type="datetime-local" id="started_at" wire:model="started_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('started_at') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="ended_at" class="block text-gray-700 text-sm font-bold mb-2">End Date (optional):</label>
            <input type="datetime-local" id="ended_at" wire:model="ended_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('ended_at') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ $isEditing ? 'Update' : 'Create' }} Subscription
            </button>
            @if ($isEditing)
                <button type="button" wire:click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <div class="mt-8">
        <h3 class="text-xl font-bold mb-4">Subscription List</h3>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">User</th>
                    <th class="py-2 px-4 border-b">Plan</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Start Date</th>
                    <th class="py-2 px-4 border-b">End Date</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $subscription->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $subscription->plan_name }}</td>
                        <td class="py-2 px-4 border-b">${{ number_format($subscription->price, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ $subscription->started_at->format('Y-m-d H:i') }}</td>
                        <td class="py-2 px-4 border-b">{{ $subscription->ended_at ? $subscription->ended_at->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td class="py-2 px-4 border-b">
                            <button wire:click="edit({{ $subscription->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                            <button wire:click="delete({{ $subscription->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded" onclick="return confirm('Are you sure you want to delete this subscription?')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $subscriptions->links() }}
        </div>
    </div>
</div>