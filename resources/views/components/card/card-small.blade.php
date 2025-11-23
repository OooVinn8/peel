@props(['image', 'title', 'category', 'price', 'id'])

<a href="{{ route('menu.menu-detail', ['id' => $id]) }}" class="block hover:scale-[1.02] transition duration-300">

    <div class="relative bg-gray-100 rounded-xl shadow-md flex overflow-hidden flex-1">
        <img src="{{ $image }}" alt="{{ $title }}" class="w-40 h-30 object-cover">

        <div class="p-4 flex-1 flex flex-col justify-center">
            <h3 class="text-lg font-bold">{{ $title }}</h3>

            <span class="inline-block bg-blue-600 text-white text-xs px-2 py-1 rounded mt-1 max-w-max">
                {{ $category }}
            </span>

            <div class="mt-2">
                <span class="text-yellow-500 font-bold">Rp{{ $price }}</span>
            </div>
        </div>
    </div>
</a>
