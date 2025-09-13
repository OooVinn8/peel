@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-[1200px] h-[600px] bg-white rounded-2xl shadow-xl overflow-hidden flex">
        
        <div class="w-[35%] flex flex-col justify-center px-10 py-12">
            <div class="w-full max-w-sm mx-auto">
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" class="w-40">
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
                            placeholder="Masukkan email" autocomplete="off" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                        <input type="password" name="password" 
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
                            placeholder="Masukkan password" autocomplete="off" required >
                    </div>
                    <x-buttonLoginRegister label="LOGIN" />
                </form>

                <p class="mt-6 text-sm text-gray-600 text-center">
                    Belum punya akun? 
                    <a href="{{ url('/register') }}" class="text-yellow-500 font-semibold hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>

        <!-- Kanan: Ilustrasi -->
        <div class="w-[65%] hidden md:flex items-center justify-center bg-gradient-to-br from-red-50 to-yellow-50">

            <div class="w-[50%] hidden md:flex flex-col items-center justify-center bg-gradient-to-br from-red-50 to-yellow-50 px-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center leading-snug">
                "Masuk untuk melanjutkan perjalananmu bersama,    
                <span class="text-blue-700">Makan</span><span class="text-yellow-600">Dulu</span>!"
            </h2>
            <lottie-player
                src="{{ asset('images/LhuvVioiPQ.json') }}"
                background="transparent"
                speed="1"
                style="width: 400px; height: 400px;"
                loop
                autoplay>
            </lottie-player>
        </div>
    </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection
