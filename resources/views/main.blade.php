<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MakanDulu</title>
  @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
  @include('layouts.navbar')

  <section class="w-full bg-white shadow-md">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-x-6 px-6 py-6 mb-10">
      <div class="max-w-xl">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
          Pesan Makanan <br> Tanpa Antre Panjang!
        </h1>
        <p class="text-gray-600 mb-8">
          Nikmati kemudahan memesan menu cafe <br> secara online
        </p>
        <a href="#"
          class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600">
          Makan yuk!
        </a>
      </div>

      <div class="mt-10 md:mt-0 flex justify-center md:flex-shrink-0 md:justify-center md:ml-40 pd-10">
        <lottie-player
          src="{{ asset('images/3qRjLQJtwZ.json') }}"
          background="transparent"
          speed="1"
          class="w-[500px] md:h-[400px]"
          loop
          autoplay>
        </lottie-player>
      </div>
    </div>
  </section>


  <section class="max-w-7xl mx-auto px-6 mb-10">
    <div class="bg-white rounded-xl shadow-md p-6 flex flex-wrap justify-between">

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/ayam.png') }}" alt="Ayam" class="w-12 h-12">
        <span class="text-sm font-medium">Ayam</span>
      </div>

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/seafood.png') }}" alt="Seafood" class="w-12 h-12">
        <span class="text-sm font-medium">Seafood</span>
      </div>

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/nasi.png') }}" alt="Nasi" class="w-12 h-12">
        <span class="text-sm font-medium">Nasi</span>
      </div>

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/mie.png') }}" alt="Mie" class="w-12 h-12">
        <span class="text-sm font-medium">Mie</span>
      </div>

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/dessert.png') }}" alt="Dessert" class="w-12 h-12">
        <span class="text-sm font-medium">Dessert</span>
      </div>

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/cemilan.png') }}" alt="Cemilan" class="w-12 h-12">
        <span class="text-sm font-medium">Cemilan</span>
      </div>

      <div class="flex flex-col items-center space-y-2 w-24 border border-gray-300 rounded-lg p-3 hover:shadow-md">
        <img src="{{ asset('images/minuman.png') }}" alt="Minuman" class="w-12 h-12">
        <span class="text-sm font-medium">Minuman</span>
      </div>

    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 mb-10 relative">
    <div class="relative rounded-xl shadow-md overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-1/2 bg-blue-600 z-0"></div>
      <div class="absolute bottom-0 left-0 w-full h-1/2 bg-white z-0"></div>

      <div class="relative z-10">
        <div class="p-8">
          <div class="flex justify-between items-center">
            <h2 class="text-2xl font-extrabold text-white">
              <img src="{{ asset('images/logo_MakanDEALS.png') }}" alt="makanDeals class" class="h-7 w-50">
            </h2>

            <div class="flex items-center space-x-2 bg-white text-blue-600 px-3 py-1 rounded-lg font-bold">
              <span id="jam">10 : 00 : 00</span>
            </div>

          </div>
        </div>

        <div class="px-8 py-0.5">
          <div class="grid md:grid-cols-3 gap-6">
            <x-card-large
              image="{{ asset('image_menu/nasi/nasi_goreng.png') }}"
              title="Nasi Goreng Seafood"
              category="Nasi"
              discount="30"
              price="14.000"
              originalPrice="20.000" />

            <div class="md:col-span-2 flex flex-col gap-7">
              <div class="md:col-span-2 flex flex-col gap-7">
                <x-card-small
                  image="{{ asset('image_menu/ayam/ayam_crispy_MD.png') }}"
                  title="Ayam Crispy MD"
                  category="Ayam"
                  discount="50"
                  price="7.500"
                  originalPrice="15.000" />
              </div>

              <div class="md:col-span-2 flex flex-col gap-7">
                <x-card-small
                  image="{{ asset('image_menu/ayam/ayam_katsu.jpg') }}"
                  title="Ayam Katsu"
                  category="Ayam"
                  discount="30"
                  price="31.500"
                  originalPrice="45.000" />
              </div>

              <div class="md:col-span-2 flex flex-col gap-7">
                <x-card-small
                  image="{{ asset('image_menu/nasi/nasi_liwet.jpg') }}"
                  title="Nasi Liwet"
                  category="Nasi"
                  discount="10"
                  price="23.500"
                  originalPrice="25.000" />
              </div>
            </div>
          </div>

          <div class="mt-1 mb-4 text-right">
            <a href="{{ route('menu.main') }}" class="text-sm text-gray-600 hover:text-black">Lihat Semua &gt;</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 mb-10 relative">
    <div class="relative rounded-xl shadow-md overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-1/4 bg-white z-0"></div>
      <div class="absolute bottom-0 left-0 w-full h-3/4 bg-blue-600 z-0"></div>
      <div class="relative z-10">
        <div class="bg-white px-6 py-6 grid grid-cols-1 md:grid-cols-2 gap-6 items-start px-10 py-5">
          <h2 class="text-xl font-extrabold text-black">
            Bingung milih? coba cek <br>
            <span class="text-yellow-500">Best Seller</span> aja!
          </h2>

          <div class="text-right">
            <span class="text-lg font-bold text-black mb-2 block">Kategori</span>
            <div class="flex gap-3 justify-end">
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Ayam</span>
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Seafood</span>
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Nasi</span>
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Mie</span>
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Dessert</span>
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Cemilan</span>
              <span class="px-4 py-1 bg-blue-500 text-white rounded-full">Minuman</span>
            </div>
          </div>
        </div>
        <div class="bg-blue-600 p-8">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card-large-best
              image="{{ asset('image_menu/ayam/ayam_kremes.jpg') }}"
              top="1"
              title="Ayam Kremes"
              category="Ayam"
              price="15.000" />

            <x-card-large-best
              image="{{ asset('image_menu/ayam/ayam_bumbu_rendang.png') }}"
              top="2"
              title="Ayam Bumbu Rendang"
              category="Ayam"
              price="20.000" />

            <x-card-large-best
              image="{{ asset('image_menu/minuman/matcha_latte.jpg') }}"
              top="3"
              title="Matcha Latte"
              category="Minuman"
              price="16.000" />
          </div>
        </div>
      </div>
    </div>
  </section>


<section class="max-w-7xl mx-auto px-6 mb-10 relative">
  <div class="relative rounded-xl shadow-md overflow-hidden bg-white">
    <div class="flex justify-between items-center bg-blue-600 px-10 py-5">
      <h2 class="text-white text-xl font-bold">Pilihan Menu</h2>
    </div>

    <div class="p-8 bg-white">
      <div class="relative">
        <div class="slides grid grid-cols-1 md:grid-cols-3 gap-6">
          <x-card-large-best
            image="{{ asset('image_menu/ayam/ayam_kremes.jpg') }}"
            top="1"
            title="Ayam Kremes"
            category="Ayam"
            price="15.000" />

          <x-card-large-best
            image="{{ asset('image_menu/ayam/ayam_bumbu_rendang.png') }}"
            top="2"
            title="Ayam Bumbu Rendang"
            category="Ayam"
            price="20.000" />

          <x-card-large-best
            image="{{ asset('image_menu/minuman/matcha_latte.jpg') }}"
            top="3"
            title="Matcha Latte"
            category="Minuman"
            price="16.000" />
        </div>

        <div class="slides hidden grid grid-cols-1 md:grid-cols-3 gap-6">
          <x-card-large-best
            image="{{ asset('image_menu/minuman/americano.jpg') }}"
            top="4"
            title="Americano"
            category="Minuman"
            price="14.000" />

          <x-card-large-best
            image="{{ asset('image_menu/seafood/cumi_goreng.jpg') }}"
            top="5"
            title="Cumi Goreng Tepung"
            category="Seafood"
            price="22.000" />

          <x-card-large-best
            image="{{ asset('image_menu/dessert/pudding_coklat.jpg') }}"
            top="6"
            title="Pudding Coklat"
            category="Dessert"
            price="10.000" />
        </div>

        <div class="slides hidden grid grid-cols-1 md:grid-cols-3 gap-6">
          <x-card-large-best
              image="{{ asset('image_menu/dessert/es_campur.jpg') }}"
              top="9"
              title="Es Campur"
              category="Dessert"
              price="12.000" />

          <x-card-large-best
              image="{{ asset('image_menu/ayam/soto_ayam.jpg') }}"
              top="10"
              title="Soto Ayam"
              category="Ayam"
              price="16.000" />
          <div class="w-full h-80 rounded-xl shadow-md bg-white flex flex-col items-center justify-center hover:shadow-xl transition duration-300 cursor-pointer">
            <a href="{{ route('menu.main') }}" class="flex flex-col items-center justify-center h-full w-full">
              <img src="{{ asset('images/right_arrow.png') }}" alt="Next" class="w-12 h-12 mb-3">
              <span class="text-gray-700 font-semibold text-lg">Lihat Semua Menu</span>
            </a>
          </div>
        </div>

        <div class="flex justify-center mt-6 space-x-3">
          <div class="dot w-3 h-3 rounded-full bg-blue-600 cursor-pointer"></div>
          <div class="dot w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></div>
          <div class="dot w-3 h-3 rounded-full bg-gray-400 cursor-pointer"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="{{ asset('js/slide_main.js') }}"></script>

@include('layouts.footer')
</body>

</html>