@props([
    'image' => '',
    'title' => '',
    'category' => '',
    'price' => '',
    'stock' => 0,
    'link' => '#',
    'productId' => null,
])

<div 
    onclick="if({{ $stock }} > 0) window.location='{{ $link }}'" 
    class="relative bg-gray-100 rounded-xl shadow overflow-hidden hover:scale-105 transition-transform duration-500 cursor-pointer
           {{ $stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}">

    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">

    <div class="p-4 flex flex-col justify-between h-[200px]">
        <div>
            <h3 class="text-lg font-bold text-gray-800">{{ $title }}</h3>

            <div class="flex items-center justify-between mt-2">
                <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                    {{ $category }}
                </span>

                <span class="text-xs {{ $stock > 0 ? 'text-blue-600' : 'text-red-500' }}">
                    {{ $stock > 0 ? 'Tersedia: ' . $stock : 'Stok Habis' }}
                </span>
            </div>

            <div class="mt-3">
                <span class="text-yellow-500 font-bold text-lg">{{ $price }}</span>
            </div>
        </div>

        @if($stock > 0)
            <form method="POST" action="{{ route('cart.store') }}" class="mt-2">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productId }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                    onclick="event.stopPropagation()"
                    class="w-full bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition cursor-pointer flex items-center justify-center space-x-2">
                    <img src="{{ asset('images/cart-menu.png') }}" class="w-5 h-5" alt="cart">
                    <span>Tambah ke Keranjang</span>
                </button>
            </form>
        @endif
    </div>
</div>
