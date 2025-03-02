@extends('layouts.app')
@section('title', 'Register | G CLOTHING')
@section('content')
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Create an account</h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">sign in to your account</a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white px-6 py-8 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" method="POST" action="/register">
                @csrf
                
                <div>
                    <x-form-label for="fullname">Full Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="fullname" id="fullname" :value="old('fullname')" placeholder="John Doe" />
                        <x-form-error name='fullname'/>
                    </div>
                </div>
                
                <div>
                    <x-form-label for="email">Email address</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="email" id="email" :value="old('email')" placeholder="you@example.com" />
                        <x-form-error name='email'/>
                    </div>
                </div>

                <div>
                    <x-form-label for="role">Role</x-form-label>
                    <div class="mt-2">
                        <select 
                            name="role" 
                            id="role" 
                            class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="">Select Role</option>
                            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-form-error name='role'/>
                    </div>
                </div>

                <div>
                    <x-form-label for="password">Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password" id="password" type="password" placeholder="••••••••" />
                        <x-form-error name='password'/>
                    </div>
                </div>

                <div>
                    <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="••••••••" />
                        <x-form-error name='password_confirmation'/>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors">
                        Create account
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-white px-2 text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0">
                        <i class="fab fa-google text-red-500"></i>
                        Google
                    </a>

                    <a href="#" class="flex w-full items-center justify-center gap-3 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0">
                        <i class="fab fa-facebook text-blue-600"></i>
                        Facebook
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection