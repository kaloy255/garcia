 @props(['active'=> false])
 <button class="{{ $active ? '' : '' }}rounded-md px-3 py-2 text-sm font-medium " aria-current="{{ $active ? 'page' : 'false' }}" {{ $attributes }}>{{ $slot }}</button>