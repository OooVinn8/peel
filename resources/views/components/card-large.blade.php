<div class="relative bg-gray-100 rounded-xl shadow overflow-hidden md:row-span-2 h-104">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-75 object-cover">
    @if($discount)
    <span class="absolute top-2 right-2 bg-yellow-500 text-black font-bold px-3 py-1 rounded-md">
        -{{ $discount }}%
    </span>
    @endif
    <div class="p-4">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1">{{ $category }}</span>
        <div class="mt-2 flex items-center space-x-2">
            <span class="text-yellow-500 font-bold">Rp{{ $price }}</span>
            @if($originalPrice)
            <span class="text-gray-400 line-through">Rp{{ $originalPrice }}</span>
            @endif
        </div>
    </div>
</div>