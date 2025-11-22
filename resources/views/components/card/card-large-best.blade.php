@props(['image', 'top' => null, 'title', 'category', 'price', 'id'])

<a href="{{ route('menu.menu-detail', $id) }}" class="block">
    <div
        class="relative bg-gray-100 rounded-xl shadow overflow-hidden md:row-span-2 h-104 hover:scale-102 transition-transform duration-500">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-75 object-cover">

        @if ($top)
            <span class="absolute top-2 right-2 bg-yellow-500 text-black font-bold px-3 py-1 rounded-md">
                Top {{ $top }}
            </span>
        @endif

        <div class="p-4">
            <h3 class="text-lg font-bold">{{ $title }}</h3>
            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1">{{ $category }}</span>
            <div class="mt-2 flex items-center space-x-2">
                <span class="text-yellow-500 font-bold">Rp{{ $price }}</span>
            </div>
        </div>
    </div>
</a>
