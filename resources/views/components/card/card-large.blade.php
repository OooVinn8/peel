@props(['image', 'title', 'category', 'price', 'id'])

<a href="{{ route('menu.menu-detail', ['id' => $id]) }}"
   class="block hover:scale-[1.02] transition duration-300">

    <div class="relative bg-gray-100 rounded-xl shadow overflow-hidden md:row-span-2 h-104">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">

        <div class="p-4">
            <h3 class="text-lg font-bold">{{ $title }}</h3>
            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1">
                {{ $category }}
            </span>

            <div class="mt-2">
                <span class="text-yellow-500 font-bold text-lg">Rp{{ $price }}</span>
            </div>
        </div>
    </div>
</a>