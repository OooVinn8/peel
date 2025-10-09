@props(['image' => '', 'title' => '', 'category' => '', 'price' => ''])

<div class="relative bg-gray-100 rounded-xl shadow overflow-hidden hover:scale-102 transition-transform duration-500">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">

    <div class="p-4">
        <h3 class="text-lg font-bold text-gray-800">{{ $title }}</h3>
        <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded mt-2">
            {{ $category }}
        </span>
        <div class="mt-3 flex items-center space-x-2">
            <span class="text-yellow-500 font-bold">{{ $price }}</span>
        </div>
    </div>
</div>