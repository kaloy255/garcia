<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Garcia Clothing')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col">
    @include('partials.header')
    
    <main class="min-h-[610px] container mx-auto p-6 flex items-center flex-col">
        @yield('content')
    </main>
    
    @include('partials.footer')
    
</body>
</html>