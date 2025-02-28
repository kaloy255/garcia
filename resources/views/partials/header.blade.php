<header class="p-5 w-full flex justify-between items-center">
   <a href="">LOGO</a>

  <form action="{{ route('products.filter') }}" method="GET" class="relative h-[35px]  min-w-[30%] ">
    <svg class="absolute top-2 left-1 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
    </svg>
    
    <input class="h-full w-full rounded-md px-7 border bg-[#e6e8e7] focus:outline focus:border-none" type="text" name="name" value="{{ request('name') }}" placeholder="Search">
  </form>

  <div class="flex items-center gap-10">
    @guest
        <a href="/login">Log in</a>
        <a href="/register">Register</a>
    @endguest

    @auth
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
      </svg>

      <a href="/logout">Log out</a>
    @endauth
  </div>

   
</header>