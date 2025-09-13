<div class="relative bg-gray-100 rounded-xl shadow-md flex overflow-hidden flex-1">
    <div class="relative h-full">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-40 h-30 object-cover">
        @if($discount)
            <span class="absolute top-0 left-0 bg-yellow-500 text-black font-bold px-2 py-1">
                -{{ $discount }}%
            </span>
        @endif
    </div>
    <div class="p-4 flex-1 flex flex-col justify-center">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1 max-w-max">{{ $category }}</span>
        <div class="mt-2 flex items-center space-x-2">
            <span class="text-yellow-500 font-bold">Rp{{ $price }}</span>
            @if($originalPrice)
                <span class="text-gray-400 line-through">Rp{{ $originalPrice }}</span>
            @endif
        </div>
    </div> 
</div>
