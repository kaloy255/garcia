
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <x-form-field>
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form method="POST" action="/login">
            @csrf
            <div class="mb-4">
                <x-form-label for="email">Email</x-form-label>
                <x-form-input name="email" id="email" :value="old('email')" placeholder="Example@gmail" />
            </div>
            <div class="mb-4">
                <x-form-label for="password">Password</x-form-label>
                <x-form-input name="password" id="password" type="password" placeholder="********" />
                <x-form-error name='password'/>
                <x-form-error name='email'/>
            </div>
           
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Login</button>
        </form>
        <p class="text-center text-gray-600 mt-4"> Don't habe an account? <a href="/register" class="text-blue-500 hover:underline">Register here</a></p>
    </x-form-field>
</body>
</html>