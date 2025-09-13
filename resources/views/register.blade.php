@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">


    <div class="w-full md:w-[1200px] md:h-[650px] bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">

        <div class="w-full md:w-[35%] flex flex-col justify-center px-6 md:px-10 py-8 md:py-12">
            <div class="w-full max-w-sm mx-auto">
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('images/logo.png') }}" class="w-32 md:w-40">
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

                <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700">Username</label>
                        <input type="text" name="username"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan username" autocomplete="off">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                        <input type="email" name="email"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan email" autocomplete="off">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1 text-gray-700">Phone Number</label>
                        <input type="text" name="phone"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Masukkan nomor HP" autocomplete="off">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                            <input type="password" name="password"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Masukkan password" autocomplete="off">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700">Konfirmasi Password</label>
                            <input type="password" name="confirmpassword"
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Masukkan ulang password" autocomplete="off">
                        </div>
                    </div>

                    <x-buttonLoginRegister label="REGISTER" />
                </form>
                <p class="mt-6 text-sm text-gray-600 text-center">
                    Sudah punya akun?
                    <a href="{{ url('/login') }}" class="text-yellow-500 font-semibold hover:underline">Masuk di sini</a>
                </p>
            </div>
        </div>

        <div class="w-full md:w-[65%] hidden md:flex flex-col items-center justify-center bg-gradient-to-br from-red-50 to-yellow-50 px-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center leading-snug">
                "Daftar untuk melanjutkan perjalananmu <br>bersama,
                <span class="text-blue-700">Makan</span><span class="text-yellow-600">Dulu</span>!"
            </h2>
            <lottie-player
                src="{{ asset('images/LhuvVioiPQ.json') }}"
                background="transparent"
                speed="1"
                style="width: 350px; height: 350px;"
                loop
                autoplay>
            </lottie-player>
        </div>
    </div>
</div>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
@endsection