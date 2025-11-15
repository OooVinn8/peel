@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-[60vh] text-center p-6">
        <img src="{{ asset('images/success.png') }}" alt="Success" class="w-32 h-32 mb-4">
        <h1 class="text-3xl font-bold text-green-600 mb-2">Pesanan Berhasil!</h1>
        <p class="text-gray-600 mb-6">Terima kasih telah memesan di <span
                class="font-semibold text-yellow-500">MakanDulu</span>.<br>
            Pesananmu sedang diproses oleh tim kami.</p>

        <a href="{{ route('home') }}"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold transition">
            Kembali ke Home
        </a>
    </div>
@endsection
