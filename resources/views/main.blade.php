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
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-8 px-6 py-10 mb-10">
      <div class="max-w-xl text-center md:text-left">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
          Pesan Makanan <br class="hidden sm:block"> Tanpa Antre Panjang!
        </h1>
        <p class="text-gray-600 mb-8 text-base sm:text-lg">
          Nikmati kemudahan memesan menu cafe <br class="hidden sm:block"> secara online
        </p>
        <a href="#"
          class="inline-block px-6 py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600 transition">
          Makan yuk!
        </a>
      </div>

      <div class="mt-10 md:mt-0 flex justify-center md:justify-end w-full md:w-auto md:ml-10 lg:ml-20">
        <div class="mt-10 md:mt-0 flex justify-center md:justify-end w-full md:w-auto ml-auto">
        <lottie-player
          src="{{ asset('images/3qRjLQJtwZ.json') }}"
          background="transparent"
          speed="1"
          class="w-72 h-72 sm:w-[400px] sm:h-[400px] md:w-[500px] md:h-[400px]"
          loop
          autoplay>
        </lottie-player>
      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-6 mb-10">
    <div class="bg-white rounded-xl shadow-md p-6 flex flex-wrap justify-center sm:justify-between gap-4">
      @php
      $kategori = [
      ['img' => 'ayam.png', 'label' => 'Ayam'],
      ['img' => 'seafood.png', 'label' => 'Seafood'],
      ['img' => 'nasi.png', 'label' => 'Nasi'],
      ['img' => 'mie.png', 'label' => 'Mie'],
      ['img' => 'dessert.png', 'label' => 'Dessert'],
      ['img' => 'cemilan.png', 'label' => 'Cemilan'],
      ['img' => 'minuman.png', 'label' => 'Minuman'],
      ];
      @endphp

      @foreach($kategori as $item)
      <div
        class="flex flex-col items-center space-y-2 w-20 sm:w-24 border border-gray-200 rounded-lg p-3 hover:shadow-md transition">
        <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['label'] }}" class="w-10 h-10 sm:w-12 sm:h-12">
        <span class="text-xs sm:text-sm font-medium">{{ $item['label'] }}</span>
      </div>
      @endforeach
    </div>
  </section>


  <!-- MakanDUlu -->
  <section class="max-w-7xl mx-auto px-6 mb-10 relative">
    <div class="relative rounded-xl shadow-md overflow-hidden">
      <div class="absolute top-0 left-0 w-full h-1/2 bg-blue-600 z-0"></div>
      <div class="absolute bottom-0 left-0 w-full h-1/2 bg-white z-0"></div>

      <div class="relative z-10">
        <div class="p-6 md:p-8">
          <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="text-xl md:text-2xl font-extrabold text-white">
              <img src="{{ asset('images/logo_MakanDEALS.png') }}" alt="makanDeals" class="h-6 md:h-7 w-auto">
            </h2>

            <div class="flex items-center bg-white text-blue-600 px-4 py-2 rounded-lg font-bold text-lg md:text-xl">
              <span id="jam">12 : 00 : 00</span>
            </div>
          </div>
        </div>

        <script src="{{ asset('js/timer.js') }}"></script>

        <div class="px-6 md:px-8 py-2">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card.card-large
              image="{{ asset('image_menu/Nasi/nasi_goreng.png') }}"
              title="Nasi Goreng Seafood"
              category="Nasi"
              discount="30"
              price="14.000"
              originalPrice="20.000" />

            <div class="md:col-span-2 flex flex-col gap-6">
              <x-card.card-small
                image="{{ asset('image_menu/Ayam/ayam-crispy-MD.png') }}"
                title="Ayam Crispy MD"
                category="Ayam"
                discount="50"
                price="7.500"
                originalPrice="15.000" />

              <x-card.card-small
                image="{{ asset('image_menu/Ayam/ayam-katsu.jpg') }}"
                title="Ayam Katsu"
                category="Ayam"
                discount="30"
                price="31.500"
                originalPrice="45.000" />

              <x-card.card-small
                image="{{ asset('image_menu/Nasi/nasi-liwet.jpg') }}"
                title="Nasi Liwet"
                category="Nasi"
                discount="10"
                price="23.500"
                originalPrice="25.000" />
            </div>
          </div>

          <div class="mt-3 mb-4 text-right">
            <a href="{{ route('menu.main') }}" class="text-sm text-gray-600 hover:text-black">Lihat Semua &gt;</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Best Seller -->
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

          <div class="text-center md:text-right">
            <span class="text-sm sm:text-lg font-bold text-black mb-2 block">Kategori</span>

            <div class="text-center md:text-right">
              <div class="flex flex-nowrap justify-center md:justify-end gap-2 overflow-x-auto">
                @foreach(['Ayam','Seafood','Nasi','Mie','Dessert','Cemilan','Minuman'] as $kat)
                <span class="px-4 py-1 bg-blue-500 text-white rounded-full text-sm whitespace-nowrap">
                  {{ $kat }}
                </span>
                @endforeach
              </div>
            </div>

          </div>
        </div>

        <div class="bg-blue-600 p-6 md:p-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <x-card.card-large-best
              image="{{ asset('image_menu/Ayam/ayam-kremes.jpg') }}"
              top="1"
              title="Ayam Kremes"
              category="Ayam"
              price="15.000" />

            <x-card.card-large-best
              image="{{ asset('image_menu/Ayam/ayam-bumbu-rendang.png') }}"
              top="2"
              title="Ayam Bumbu Rendang"
              category="Ayam"
              price="20.000" />

            <x-card.card-large-best
              image="{{ asset('image_menu/Minuman/Iced_matcha_latte.png') }}"
              top="3"
              title="Matcha Latte"
              category="Minuman"
              price="16.000" />
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

      <div class="p-6 md:p-8 bg-white">
        <div class="relative">
          <div class="slides grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <x-card.card-large-pilihan
              image="{{ asset('image_menu/Cemilan/kentang_goreng.png') }}"
              title="Kentang Goreng"
              category="Cemilan"
              price="15.000" />

            <x-card.card-large-pilihan
              image="{{ asset('image_menu/Dessert/es_shanghai.png') }}"
              title="Es Shanghai"
              category="Dessert"
              price="10.000" />

            <x-card.card-large-pilihan
              image="{{ asset('image_menu/Ayam/ayam-pop.jpg') }}"
              title="Ayam Pop"
              category="Ayam"
              price="24.000" />
          </div>

          <div class="slides hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <x-card.card-large-pilihan
              image="{{ asset('image_menu/Minuman/americano.jpg') }}"
              title="Americano"
              category="Minuman"
              price="14.000" />

            <x-card.card-large-pilihan
              image="{{ asset('image_menu/Seafood/cumi-saus-padang.jpg') }}"
              title="Cumi Saus Padang"
              category="Seafood"
              price="22.000" />

            <x-card.card-large-pilihan
              image="{{ asset('image_menu/Dessert/pudding_coklat.jpg') }}"
              title="Pudding Coklat"
              category="Dessert"
              price="10.000" />
          </div>

          <div class="slides hidden grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <x-card.card-large-pilihan
              image="{{ asset('image_menu/dessert/es_campur.jpg') }}"
              title="Es Campur"
              category="Dessert"
              price="12.000" />

            <x-card.card-large-pilihan
              image="{{ asset('image_menu/ayam/soto_ayam.jpg') }}"
              title="Soto Ayam"
              category="Ayam"
              price="16.000" />

            <div
              class="w-full h-60 sm:h-72 md:h-80 rounded-xl shadow-md bg-white flex flex-col items-center justify-center hover:shadow-xl transition cursor-pointer">
              <a href="{{ route('menu.main') }}" class="flex flex-col items-center justify-center h-full w-full">
                <img src="{{ asset('images/right_arrow.png') }}" alt="Next" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-3">
                <span class="text-gray-700 font-semibold text-base sm:text-lg">Lihat Semua Menu</span>
              </a>
            </div>
          </div>

          <div class="flex justify-center mt-6 space-x-2 sm:space-x-3">
            <div class="dot w-2.5 sm:w-3 h-2.5 sm:h-3 rounded-full bg-blue-600 cursor-pointer"></div>
            <div class="dot w-2.5 sm:w-3 h-2.5 sm:h-3 rounded-full bg-gray-400 cursor-pointer"></div>
            <div class="dot w-2.5 sm:w-3 h-2.5 sm:h-3 rounded-full bg-gray-400 cursor-pointer"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ asset('js/slide_main.js') }}"></script>
  @include('layouts.footer')
</body>

</html>