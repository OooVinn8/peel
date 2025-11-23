<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MakanDulu</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
    @include('layouts.navbar')

    <section class="w-full bg-white shadow-md">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-8 px-6 py-10 mb-10">
            <div class="max-w-xl text-center md:text-left">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                    Pesan Makanan <br class="hidden sm:block"> Tanpa Antre Panjang!
                </h1>
                <p class="text-gray-600 mb-8 text-base sm:text-lg">
                    Nikmati kemudahan memesan menu cafe <br class="hidden sm:block"> secara online
                </p>
                <a href="#makanDeals" id="scrollButton"
                    class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition">
                    Makan yuk!
                </a>
            </div>

            <div class="mt-10 md:mt-0 flex justify-center md:justify-end w-full md:w-auto md:ml-10 lg:ml-20">
                <div class="mt-10 md:mt-0 flex justify-center md:justify-end w-full md:w-auto ml-auto">
                    <lottie-player src="{{ asset('images/3qRjLQJtwZ.json') }}" background="transparent" speed="1"
                        class="w-72 h-72 sm:w-[400px] sm:h-[400px] md:w-[500px] md:h-[400px]" loop autoplay>
                    </lottie-player>
                </div>
            </div>
    </section>

    <!-- Category -->
    <section class="max-w-7xl mx-auto px-6 mb-10">
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-wrap justify-center sm:justify-between gap-4">

            @foreach ($categories as $item)
                <a href="{{ route('menu.main', ['category' => strtolower($item->name)]) }}"
                    class="flex flex-col items-center space-y-2 w-20 sm:w-24 border border-gray-200 rounded-lg p-3 hover:shadow-md transition-transform duration-500 transform hover:scale-105">

                    <img src="{{ asset('image_category/' . $item->image) }}" alt="{{ $item->name }}"
                        class="w-10 h-10 sm:w-12 sm:h-12">

                    <span class="text-xs sm:text-sm font-medium">{{ $item->name }}</span>
                </a>
            @endforeach

        </div>
    </section>


    <!-- MakanDulu -->
    <section id="makanDeals" class="max-w-7xl mx-auto px-6 mb-10 relative">
        <div class="relative rounded-xl shadow-md overflow-hidden">

            <!-- Background layer -->
            <div class="absolute top-0 left-0 w-full h-1/2 bg-blue-600 z-0"></div>
            <div class="absolute bottom-0 left-0 w-full h-1/2 bg-white z-0"></div>

            <div class="relative z-10">
                <!-- Header -->
                <div class="p-6 md:p-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <h2 class="text-xl md:text-2xl font-extrabold text-white">
                            <img src="{{ asset('images/logo_MakanDEALS.png') }}" alt="makanDeals"
                                class="h-6 md:h-7 w-auto">
                        </h2>

                        <div
                            class="flex items-center bg-white text-blue-600 px-4 py-2 rounded-lg font-bold text-lg md:text-xl">
                            <span id="jam" data-expire="{{ $expiresAt }}">00:00:00</span>
                        </div>
                    </div>
                </div>

                <script src="{{ asset('js/timer.js') }}"></script>

                <!-- Content -->
                <div class="px-6 md:px-8 py-2">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        @foreach ($products as $key => $product)
                            @if ($key === 0)
                                <!-- Card besar -->
                                <x-card.card-large :image="asset('image_menu/' . $product->category->name . '/' . $product->image)" :title="$product->name" :category="$product->category->name"
                                    :price="number_format($product->price)" :id="$product->id" />
                            @else
                                {{-- Buka wrapper kecil pas card kedua --}}
                                @if ($key === 1)
                                    <div class="md:col-span-2 flex flex-col gap-6">
                                @endif

                                <!-- Card kecil -->
                                <x-card.card-small :image="asset('image_menu/' . $product->category->name . '/' . $product->image)" :title="$product->name" :category="$product->category->name"
                                    :price="number_format($product->price)" :id="$product->id" />

                                {{-- Tutup wrapper di akhir --}}
                                @if ($loop->last)
                    </div>
                    @endif
                    @endif
                    @endforeach

                </div>
            </div>

            <!-- Lihat semua -->
            <div class="mt-3 mb-4 mr-8 text-right">
                <a href="{{ route('menu.main') }}" class="text-sm text-gray-600 hover:text-black">
                    Lihat Semua &gt;
                </a>
            </div>
        </div>
        </div>
    </section>

    <!-- Best Seller Section -->
    <section class="max-w-7xl mx-auto px-6 mb-10 relative">
        <div class="relative rounded-xl shadow-md overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1/4 bg-white z-0"></div>
            <div class="absolute bottom-0 left-0 w-full h-3/4 bg-blue-600 z-0"></div>

            <div class="relative z-10">
                <div class="bg-white px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <h2 class="text-lg sm:text-xl font-extrabold text-black text-center md:text-left">
                        Bingung milih? <br class="hidden sm:block">
                        coba cek <span class="text-yellow-500">Best Seller</span> aja!
                    </h2>
                </div>

                <div class="bg-blue-600 p-6 md:p-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                        @foreach ($recommended as $key => $product)
                            <x-card.card-large-best :image="asset('image_menu/' . $product->category->name . '/' . $product->image)" :top="$key + 1" :title="$product->name"
                                :category="$product->category->name ?? '-'" :price="number_format($product->price, 0, ',', '.')" :id="$product->id" />
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pilihan Menu -->
    <section class="max-w-7xl mx-auto px-6 mb-10 relative">
        <div class="relative rounded-xl shadow-md overflow-hidden bg-white">
            <div class="flex justify-between items-center bg-blue-600 px-6 md:px-10 py-4">
                <h2 class="text-white text-lg md:text-xl font-bold">Pilihan Menu</h2>
            </div>

            @php
                $menus = $randomProducts->take(8);
                $menus->push(collect(['id' => null])); // slot ke-9 jadi tombol lihat semua
                $chunks = $menus->chunk(3);
            @endphp

            <div class="p-6 md:p-8 bg-white">
                <div class="relative overflow-hidden">

                    <!-- Slides -->
                    <div id="slidesTrack" class="flex transition-transform duration-500">
                        @foreach ($chunks as $chunk)
                            <div
                                class="slide min-w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 overflow-hidden">
                                @foreach ($chunk as $menu)
                                    @if (isset($menu->id))
                                        <!-- Normal Card -->
                                        <x-card.card-large-pilihan :image="asset('image_menu/' . $menu->category->name . '/' . $menu->image)" :title="$menu->name"
                                            :category="$menu->category->name ?? '-'" :price="number_format($menu->price, 0, ',', '.')" :link="route('menu.menu-detail', ['id' => $menu->id])" :stock="$menu->stock"
                                            :product-id="$menu->id" />
                                    @else
                                        <!-- Card "Lihat Semua Menu" -->
                                        <a href="{{ route('menu.main') }}"
                                            class="flex flex-col items-center justify-center border-2 border-blue-500 rounded-xl hover:bg-blue-50 transition duration-300 p-6 text-center">
                                            <img src="{{ asset('images/right_arrow.png') }}"
                                                class="w-14 h-14 mb-3 opacity-80" />
                                            <p class="font-semibold text-blue-600 text-lg">Lihat Semua Menu</p>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <!-- Buttons -->
                    <button id="prevBtn"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-200 transition opacity-0 pointer-events-none duration-300">
                        <img src="{{ asset('images/left_arrow.png') }}" class="w-5 h-5" />
                    </button>

                    <button id="nextBtn"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-200 transition">
                        <img src="{{ asset('images/right_arrow.png') }}" class="w-5 h-5" />
                    </button>

                </div>

                <!-- Dots -->
                <div class="flex justify-center mt-5 gap-2">
                    @foreach ($chunks as $index => $chunk)
                        <div class="dot w-3 h-3 rounded-full cursor-pointer transition 
                        {{ $index === 0 ? 'bg-blue-600' : 'bg-gray-400' }}"
                            data-index="{{ $index }}">
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <script src="{{ asset('js/slide_main.js') }}"></script>
    @include('layouts.footer')
</body>
<script>
    document.getElementById('scrollButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('makanDeals').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

</html>
