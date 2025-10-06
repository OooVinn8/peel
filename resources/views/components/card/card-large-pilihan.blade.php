@props(['image' => '', 'title' => '', 'category' => '', 'price' => '', 'rating' => '5.0'])

<div class="relative bg-gray-100 rounded-xl shadow overflow-hidden hover:scale-105 transition-transform duration-300">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">

    <div class="p-4 flex flex-col justify-between h-[200px]">
        <div>
            <h3 class="text-lg font-bold text-gray-800 flex justify-between items-center">
                {{ $title }}
                <span class="text-gray-500 text-xl">☆</span>
            </h3>

            <div class="flex items-center space-x-2 mt-2">
                <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                    {{ $category }}
                </span>
                <span class="text-yellow-500 text-sm flex items-center">
                    ⭐ {{ $rating }}
                </span>
            </div>

            <div class="mt-3">
                <span class="text-yellow-500 font-bold text-lg">{{ $price }}</span>
            </div>
        </div>
        <button class="mt-4 bg-yellow-400 text-white w-full py-2 rounded-lg hover:bg-yellow-500 flex items-center justify-center space-x-2 font-semibold">
            <img src="{{ asset('images/cart-menu.png') }}" alt="Cart" class="w-5 h-5">
            <span>Tambah ke Keranjang</span>
        </button>
    </div>
</div>
