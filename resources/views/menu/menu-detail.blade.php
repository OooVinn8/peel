@extends('layouts.app')

@section('content')
<div class="p-8">
    <a href="{{ url()->previous() }}" 
       class="inline-flex items-center text-yellow-600 hover:text-yellow-700 font-semibold mb-4">
        ← Kembali
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
        <!-- Gambar produk -->
        <div>
            <img src="{{ asset('image_menu/' . $menu->category->name . '/' . $menu->image) }}" 
                 alt="{{ $menu->name }}" 
                 class="w-full h-[480px] object-cover rounded-lg shadow">
        </div>

        <!-- Detail produk -->
        <div class="flex flex-col justify-start space-y-4">
            <div>
                <h1 class="text-4xl font-bold text-gray-800">{{ $menu->name }}</h1>

                @if($menu->category)
                    <span class="inline-block bg-blue-600 text-white text-xs px-3 py-1 rounded mt-2">
                        {{ $menu->category->name }}
                    </span>
                @endif
            </div>

            <p class="text-gray-700 leading-relaxed">
                {{ $menu->description }}
            </p>

            <div class="text-yellow-500 font-bold text-3xl">
                Rp{{ number_format($menu->price, 0, ',', '.') }}
            </div>

            <div class="flex items-center space-x-3 mt-2">
                <label for="quantity" class="text-gray-800 font-bold text-lg">Kuantitas</label>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="decrementQty()" class="rounded-full">
                        <img src="{{ asset('images/minus-icon.png') }}" alt="Minus" class="w-8 h-8">
                    </button>

                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="100"
                           class="w-16 text-center border border-gray-300 rounded-md text-lg font-semibold">

                    <button type="button" onclick="incrementQty()" class="rounded-full">
                        <img src="{{ asset('images/plus-icon.png') }}" alt="Plus" class="w-8 h-8">
                    </button>
                </div>
            </div>

            <button class="bg-yellow-400 text-white w-full py-3 rounded-lg hover:bg-yellow-500 flex items-center justify-center space-x-2 font-semibold text-lg mt-3">
                <img src="{{ asset('images/cart-menu.png') }}" alt="Cart" class="w-6 h-6">
                <span>Tambah ke Keranjang</span>
            </button>
        </div>
    </div>
</div>

<script>
function incrementQty() {
    const qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
}

function decrementQty() {
    const qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) qty.value = parseInt(qty.value) - 1;
}
</script>
@endsection
