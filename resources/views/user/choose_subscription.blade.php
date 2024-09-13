<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Subscription</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-5 text-center">Choose Your Subscription</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(['silver', 'gold', 'platinum'] as $plan)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold mb-4 capitalize">{{ $plan }}</h2>
                    <p class="mb-4">
                        @if($plan == 'silver')
                            Access to basic courses
                        @elseif($plan == 'gold')
                            Access to premium courses
                        @else
                            Access to all courses and exclusive content
                        @endif
                    </p>
                    <p class="text-xl font-bold mb-4">
                        ${{ $plan == 'silver' ? '9.99' : ($plan == 'gold' ? '19.99' : '29.99') }}/month
                    </p>
                    <form action="{{ route('subscription.checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan" value="{{ $plan }}">
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                            Subscribe
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>