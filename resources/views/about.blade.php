@extends('layouts.app')
@include('layouts.navbar')

@section('title', 'Tentang Kami - MakanDulu')

@section('content')
{{-- HERO SECTION --}}
<div class="relative overflow-hidden">
    <img src="{{ asset('images/banner.jpg') }}"
        alt="Tentang Kami"
        class="w-full h-[550px] object-cover brightness-[0.65]">
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/10"></div>
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white">
        <h1 class="text-6xl font-extrabold mb-6 tracking-wide drop-shadow-2xl flex flex-wrap justify-center items-center gap-2">
            <span class="text-white">Tentang</span>
            <span class="relative">
                <span class="text-blue-600">Makan</span><span class="text-yellow-500">Dulu</span>
            </span>
        </h1>
        <p class="max-w-2xl text-lg font-light leading-relaxed text-blue-50">
            Tempat di mana rasa, cerita, dan suasana bersatu dalam setiap suapan. Di sinilah waktu berhenti sejenak — untuk menikmati hidup, sebelum melangkah lagi.
        </p>
    </div>
</div>

{{-- CERITA KAMI --}}
<div class="w-full bg-white py-24 grid md:grid-cols-2 gap-16 items-center">
    <div class="order-2 md:order-1 px-10 md:px-20" data-aos="fade-right">
        <h2 class="text-4xl font-extrabold text-blue-600 mb-6">
            Cerita Kami
        </h2>
        <div class="h-1 w-24 bg-yellow-400 mb-6 rounded"></div>
        <p class="text-gray-700 leading-relaxed mb-4">
            Semua bermula dari sebuah ide sederhana — bagaimana jika makan tidak sekadar soal kenyang, tapi juga tentang kenyamanan, kehangatan, dan kebersamaan. Dari situ lahirlah <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>, sebuah tempat di mana setiap orang bisa berhenti sejenak dari rutinitas dan menikmati waktu dengan tenang.
        </p>
        <p class="text-gray-700 leading-relaxed">
            Kami percaya bahwa setiap hidangan punya cerita, dan setiap pelanggan membawa kisahnya sendiri. Dengan suasana yang hangat dan pelayanan yang tulus, kami ingin setiap kunjungan menjadi momen yang berarti — entah untuk bekerja, berbagi tawa, atau sekadar menikmati kopi di sore hari.
        </p>
    </div>

    <div class="order-1 md:order-2 flex justify-center" data-aos="fade-left">
        <div class="relative">
            <div class="absolute -inset-4 bg-yellow-300 rounded-3xl blur-2xl opacity-20"></div>
            <img src="{{ asset('images/suasana.jpg') }}"
                alt="Suasana Cafe"
                class="rounded-3xl shadow-xl hover:shadow-2xl hover:scale-105 transition-transform duration-700 ease-out w-72 md:w-[380px] lg:w-[420px]">
        </div>
    </div>
</div>

{{-- PENEMU MAKAN DULU --}}
<div class="bg-gray-100 py-20 w-full">
    <div class="text-center mb-14">
        <h2 class="text-3xl md:text-4xl font-extrabold text-blue-600 mb-3">
            Penemu <span class="text-yellow-500">MakanDulu</span>
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto text-base md:text-lg">
            Di balik setiap cita rasa dan suasana hangat <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>,
            ada tiga sosok yang menyatukan visi dan semangat.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 px-6 md:px-20 text-center">
        {{-- Founder 1 --}}
        <div class="bg-white rounded-3xl p-6 shadow-md hover:shadow-xl transition duration-500 hover:-translate-y-2">
            <img src="{{ asset('image_founder/davin.png') }}"
                alt="Davin Octaryan"
                class="w-32 h-32 object-cover rounded-full mx-auto mb-5 border-4 border-yellow-400 shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-1">Davin Octaryan</h3>
            <p class="text-gray-600 text-sm mb-3">Co-Founder & Head Chef</p>
            <p class="text-gray-700 text-sm leading-relaxed">
                "Di <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>. setiap rasa punya makna — kami masak bukan cuma buat kenyang, tapi buat dikenang.”
            </p>
        </div>

        {{-- Founder 2 --}}
        <div class="bg-white rounded-3xl p-6 shadow-md hover:shadow-xl transition duration-500 hover:-translate-y-2">
            <img src="{{ asset('image_founder/hanssen.png') }}"
                alt="Hanssen"
                class="w-32 h-32 object-cover rounded-full mx-auto mb-5 border-4 border-yellow-400 shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-1">Hanssen</h3>
            <p class="text-gray-600 text-sm mb-3">Co-Founder & Creative Director</p>
            <p class="text-gray-700 text-sm leading-relaxed">
                "Buat kami, <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>, bukan sekadar tempat makan, tapi ruang hangat buat berbagi cerita.”
            </p>
        </div>

        {{-- Founder 3 --}}
        <div class="bg-white rounded-3xl p-6 shadow-md hover:shadow-xl transition duration-500 hover:-translate-y-2">
            <img src="{{ asset('image_founder/kevin.png') }}"
                alt="Kevin Alera"
                class="w-32 h-32 object-cover rounded-full mx-auto mb-5 border-4 border-yellow-400 shadow-md">
            <h3 class="text-xl font-bold text-blue-700 mb-1">Kevin Alera</h3>
            <p class="text-gray-600 text-sm mb-3">Co-Founder & Operations Lead/p>
            <p class="text-gray-700 text-sm leading-relaxed">
                “Semua hal kecil di <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span> kami jaga dengan sepenuh hati — karena kebahagiaan pelanggan selalu jadi resep utama.”
            </p>
        </div>
    </div>
</div>


{{-- NILAI KAMI --}}
<div class="bg-white py-24 w-full">
    <div class="w-full text-center">
        <h2 class="text-4xl font-extrabold text-blue-600 mb-8">Nilai yang Kami Pegang</h2>
        <p class="max-w-3xl mx-auto text-gray-700 text-lg leading-relaxed mb-16">
            Di <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>, setiap detail kami pikirkan dengan cinta —
            mulai dari bahan pilihan, cara penyajian, hingga pelayanan yang hangat.
            Kami ingin setiap tamu merasakan bahwa di sini, makan bukan hanya kebutuhan,
            tapi juga kebahagiaan kecil yang berharga.
        </p>

        <div class="grid md:grid-cols-3 gap-10 px-10 md:px-20">
            <div class="bg-white rounded-3xl p-10 shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-500">
                <h3 class="text-2xl font-semibold text-blue-800 mb-3">Kualitas Rasa</h3>
                <p class="text-gray-700 leading-relaxed">
                    Setiap hidangan kami racik dari bahan segar dan resep yang terjaga,
                    agar setiap suapan menghadirkan rasa yang jujur dan memuaskan.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-500">
                <h3 class="text-2xl font-semibold text-blue-800 mb-3">Suasana Nyaman</h3>
                <p class="text-gray-700 leading-relaxed">
                    Biru untuk ketenangan, kuning untuk kehangatan — dua warna yang berpadu menciptakan
                    ruang menenangkan hati dan menumbuhkan semangat positif.
                </p>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-md hover:shadow-xl hover:-translate-y-2 transition duration-500">
                <h3 class="text-2xl font-semibold text-blue-800 mb-3">Pelayanan Sepenuh Hati</h3>
                <p class="text-gray-700 leading-relaxed">
                    Kami tidak hanya menyajikan makanan, tetapi juga perhatian.
                    Karena bagi kami, pelanggan bukan sekadar tamu — melainkan bagian dari keluarga
                    <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>.
                </p>
            </div>
        </div>
    </div>
</div>

{{-- PENUTUP --}}
<div class="bg-gray-100 text-center py-24 w-full">
    <h2 class="text-5xl font-extrabold mb-8 tracking-wide text-blue-700">
        Lebih dari Sekadar <span class="text-yellow-500">Cafe</span>
    </h2>

    <p class="text-lg text-gray-700 leading-relaxed mb-10 max-w-3xl mx-auto">
        <span class="text-blue-600 font-semibold">Makan</span><span class="text-yellow-500 font-semibold">Dulu</span>
        bukan hanya tempat untuk makan, tapi tempat untuk merasa.
        Di sini, setiap aroma, warna, dan rasa berpadu menciptakan pengalaman yang menenangkan.
        Karena bagi kami, sebelum melangkah lebih jauh — yuk,
        <strong class="text-yellow-500">Makan Dulu.</strong>
    </p>

    <a href="{{ url('/menu') }}"
        class="mt-6 inline-block bg-yellow-400 hover:bg-yellow-300 text-blue-600 font-semibold px-8 py-3 rounded-full shadow-md transition transform hover:-translate-y-1">
        Jelajahi Menu Kami
    </a>
</div>

@include('layouts.footer')
@endsection