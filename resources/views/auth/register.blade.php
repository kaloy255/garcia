<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <x-form-field>
        <h2 class="text-2xl font-bold mb-6 text-center">Register</h2>
        <form method="POST" action="/register">
            @csrf
            <div class="mb-4">
                <x-form-label for="fullname">Full Name</x-form-label>
                <x-form-input name="fullname" id="fullname" placeholder="Fullname" />
                <x-form-error name='fullname'/>
            </div>
            <div class="mb-4">
                <x-form-label for="email">Email</x-form-label>
                <x-form-input name="email" id="email" placeholder="Example@gmail" />
                <x-form-error name='email'/>
            </div>
            <div class="mb-4">
                <x-form-label for="role">Role</x-form-label>
                <select name="role" id="" class="py-2 w-full rounded-md border border-gray-300">
                    <option value="">Select Role</option>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
                <x-form-error name='role'/>
            </div>
            <div class="mb-4">
                <x-form-label for="password">Password</x-form-label>
                <x-form-input name="password" id="password" type="password" placeholder="********" />
                <x-form-error name='password'/>
            </div>
            <div class="mb-6">
                <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="********" />
                <x-form-error name='password_confirmation'/>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Register</button>
        </form>
        <p class="text-center text-gray-600 mt-4">Already have an account? <a href="login" class="text-blue-500 hover:underline">Login here</a></p>
    </x-form-field>
</body>
</html>