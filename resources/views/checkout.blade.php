<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold text-center mb-6">Choose Your Subscription</h2>
        
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Select Plan</label>
                <select name="plan" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="silver">Silver - $9.99</option>
                    <option value="gold">Gold - $19.99</option>
                    <option value="platinum">Platinum - $29.99</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
