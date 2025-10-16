@props(['image' => '', 'title' => '', 'category' => '', 'price' => '', 'rating' => '0,0'])

<div class="relative bg-gray-100 rounded-xl shadow overflow-hidden hover:scale-105 transition-transform duration-500">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    <div class="p-4 flex flex-col justify-between h-[200px]">
        <div>
            <h3 class="text-lg font-bold text-gray-800">
                {{ $title }}
            </h3>
            <div class="flex items-center justify-between mt-2">
                <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded">
                    {{ $category }}
                </span>
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/star-rating.png') }}" alt="Star" class="w-5 h-5 inline-block">
                    <span class="text-yellow-500 text-sm font-semibold">{{ $rating }}</span>
                </div>
            </div>
            <div class="mt-3">
                <span class="text-yellow-500 font-bold text-lg">{{ $price }}</span>
            </div>
        </div>
        <x-button.buttonTambahKeKeranjang>
                Tambah ke Keranjang
        </x-button.buttonTambahKeKeranjang>
    </div>
</div>
