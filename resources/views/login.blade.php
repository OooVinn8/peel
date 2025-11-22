@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4 py-8">
    <div class="w-full max-w-6xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row min-h-[650px]">

        <div class="w-full md:w-[35%] flex flex-col justify-center px-6 sm:px-10 py-12">
            <div class="w-full max-w-sm mx-auto">
                <div class="flex justify-center mb-10">
                    <img src="{{ asset('images/logo.png') }}" class="w-32 sm:w-40">
                </div>

                @if(session('error'))
                <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm">
                    {{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div class="bg-green-100 text-green-600 p-3 rounded-lg mb-4 text-sm">
                    {{ session('success') }}
                </div>
                @endif

                

                <form action="/login" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                        <input type="email" name="email"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan email" autocomplete="off" required autofocus>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                        <input type="password" name="password"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan password" autocomplete="off" required>
                    </div>
                    <x-button.buttonLoginRegister label="LOGIN" />
                </form>

                <p class="mt-8 text-sm text-gray-600 text-center">
                    Belum punya akun?
                    <a href="{{ url('/register') }}" class="text-yellow-500 font-semibold hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>

        <div class="w-full md:w-[65%] hidden md:flex items-center justify-center bg-gradient-to-br from-red-50 to-yellow-50 px-6">
            <div class="flex flex-col items-center justify-center text-center">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-700 mb-8 leading-snug">
                    "Masuk untuk melanjutkan perjalananmu bersama,
                    <span class="text-blue-700">Makan</span><span class="text-yellow-600">Dulu</span>!"
                </h2>
                <lottie-player
                    src="{{ asset('images/LhuvVioiPQ.json') }}"
                    background="transparent"
                    speed="1"
                    style="width: 350px; height: 350px; max-width: 420px; max-height: 420px;"
                    loop
                    autoplay>
                </lottie-player>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection