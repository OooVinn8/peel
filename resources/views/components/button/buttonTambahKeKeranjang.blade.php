<button
    {{ $attributes->merge(['class' => 'bg-yellow-500 text-white w-full py-3 rounded-lg hover:bg-yellow-600 flex items-center justify-center space-x-2 font-semibold text-lg mt-3 cursor-pointer']) }}>
    <img src="{{ $icon ?? asset('images/cart-menu.png') }}" alt="Cart" class="w-6 h-6">
    <span>{{ $slot }}</span>
</button>
