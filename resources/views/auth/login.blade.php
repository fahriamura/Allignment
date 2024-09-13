<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> <!-- Include Tailwind CSS -->
    <script src="https://unpkg.com/alpinejs@3.0.6/dist/cdn.min.js"></script> <!-- Include Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body class="flex items-center justify-center h-screen bg-gradient-to-r from-white-500 to-white-600">

    <div x-data="{ email: '', password: '', showPassword: false, errorMessage: '' }" class="bg-gradient-to-r from-blue-500 to-purple-600 p-8 rounded-lg shadow-md w-96">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Login</h2>
        
        <!-- Error Message -->
        <template x-if="errorMessage">
            <div class="mb-4 text-red-600" x-text="errorMessage"></div>
        </template>

        <form method="POST" action="{{ route('login') }}" @submit.prevent="if (!email || !password) { errorMessage = 'Please fill in all fields'; return; } $el.submit();">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" x-model="email">
            </div>
            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" x-model="password">
                <button type="button" class="absolute right-2 top-2 text-gray-600" @click="showPassword = !showPassword">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7C2.9 8.205 7.524 4 12 4c.941 0 1.86.109 2.738.317M21 21l-2-2m-2.178-2.178A9.964 9.964 0 0112 19c-4.478 0-8.268-2.943-9.542-7C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7 0 1.878-.504 3.646-1.382 5.178z"/>
                    </svg>
                </button>
            </div>
            <div class="mt-4">
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Login</button>
            </div>
        </form>

        <div class="mt-4">
            <p class="text-center text-gray-600">Or login with:</p>
            <div class="flex justify-center mt-2">
                <a href="{{ route('social.login', 'google') }}" class="mx-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">Google</a>
                <a href="{{ route('social.login', 'facebook') }}" class="mx-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Facebook</a>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a></p>
        </div>
    </div>

</body>
</html>
