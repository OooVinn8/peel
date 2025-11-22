@extends('layouts.app')

@section('content')
    <div
        class="flex flex-col items-center justify-center min-h-screen bg-white p-6">

        <!-- Lottie Animation -->
        <div class="mb-8">
            <lottie-player src="{{ asset('images/Success animation.json') }}" background="transparent" speed="1"
                style="width: 250px; height: 250px;" loop autoplay>
            </lottie-player>
        </div>

        <!-- Title -->
        <h1 class="text-4xl md:text-5xl font-extrabold text-green-600 mb-4 drop-shadow-md">
            Pesanan Berhasil!
        </h1>

        <!-- Subtitle -->
        <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-xl">
            Terima kasih telah memesan di
            <span class="font-bold">
                <span class="text-blue-600">Makan</span><span class="text-yellow-500">Dulu</span>
            </span>.<br>
            Pesananmu sedang diproses oleh tim kami.
        </p>

        <!-- Kembali ke Home Button -->
        <a href="{{ route('home') }}"
            class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg transition-all transform hover:-translate-y-1 hover:scale-105">
            Kembali ke Home
        </a>

        <lottie-player src="{{ asset('images/Confetti.json') }}" background="transparent" speed="1"
            style="position: absolute; top:0; left:0; width:100%; height:100%; pointer-events:none;" autoplay loop>
        </lottie-player>

    </div>

    <!-- Lottie Player Script -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection
