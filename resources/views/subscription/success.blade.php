<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10 text-center">
        <h1 class="text-3xl font-bold mb-5">Subscription Successful!</h1>
        <p class="mb-5">Thank you for subscribing. You now have access to our courses.</p>
        <a href="{{ route('user.dashboard') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
            Go to Dashboard
        </a>
    </div>
</body>
</html>
