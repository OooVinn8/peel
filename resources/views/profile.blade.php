<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 font-sans">
    @include('layouts.navbar')

    <div class="max-w-6xl mx-auto mt-6 p-4 sm:p-6" x-data="{ tab: 'personal' }">

        <!-- TAB BUTTONS -->
        <div class="flex flex-wrap justify-center md:justify-start space-x-4 border-b mb-6">
            <button @click="tab = 'personal'"
                :class="tab === 'personal' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
                class="pb-2 font-semibold text-sm sm:text-base">
                Data Pribadi
            </button>

            <button @click="tab = 'orders'"
                :class="tab === 'orders' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
                class="pb-2 font-semibold text-sm sm:text-base">
                Pesanan
            </button>

            <button @click="tab = 'history'"
                :class="tab === 'history' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
                class="pb-2 font-semibold text-sm sm:text-base">
                History
            </button>
        </div>

        <!-- TAB: DATA PRIBADI -->
        <div x-show="tab === 'personal'" class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="md:col-span-2 bg-white rounded-lg shadow p-4 sm:p-6">
                <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Data Pribadi</h2>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" value="{{ $user->username }}" readonly
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" value="{{ $user->email }}" readonly
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" value="{{ $user->phone }}" readonly
                            class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm sm:text-base focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center justify-center relative">
                <h2 class="text-lg font-bold text-blue-900 mb-4">Foto Profil</h2>
                <div class="relative">
                    <img src="{{ $user->profile_picture ? asset('uploads/profile_pictures/' . $user->profile_picture) : asset('uploads/profile_pictures/default.jpg') }}"
                        alt="Profile Picture"
                        class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md">

                    <label for="profile_picture"
                        class="absolute bottom-2 right-2 bg-blue-600 p-2 rounded-full cursor-pointer hover:bg-blue-700 transition">
                        <img src="{{ asset('images/camera.png') }}" alt="Upload" class="w-5 h-5">
                    </label>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input id="profile_picture" type="file" name="profile_picture" class="hidden"
                            onchange="this.form.submit()">
                    </form>
                </div>

                @if ($user->profile_picture)
                    <p class="mt-4 text-sm text-gray-700 italic text-center">
                        Mantap! Kamu sudah pakai foto profil<br>
                        Yuk, lanjut jelajahi
                        <span class="text-blue-600 font-semibold">Makan</span>
                        <span class="text-yellow-500 font-semibold">Dulu</span>!
                    </p>
                @else
                    <p class="mt-4 text-sm text-gray-500 italic text-center">
                        Belum pakai foto profil nih!<br>
                        Ayo upload biar profilmu makin keren di
                        <span class="text-blue-600 font-semibold">Makan</span>
                        <span class="text-yellow-500 font-semibold">Dulu</span>!
                    </p>
                @endif
            </div>
        </div>


        <!-- TAB: PESANAN -->
        <div x-show="tab === 'orders'" class="bg-white rounded-lg shadow p-4 sm:p-6 mt-6">
            <h2 class="text-lg sm:text-xl font-bold mb-4 text-black text-center">Daftar Pesanan</h2>

            @if(isset($orders) && $orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-2 px-4 text-sm font-semibold text-gray-700 border-b">No</th>
                                <th class="py-2 px-4 text-sm font-semibold text-gray-700 border-b">Produk</th>
                                <th class="py-2 px-4 text-sm font-semibold text-gray-700 border-b">Tanggal</th>
                                <th class="py-2 px-4 text-sm font-semibold text-gray-700 border-b">Total</th>
                                <th class="py-2 px-4 text-sm font-semibold text-gray-700 border-b">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 text-sm text-gray-600 border-b">{{ $index + 1 }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-600 border-b">{{ $order->product->name ?? '-' }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-600 border-b">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-600 border-b">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4 text-sm font-semibold border-b 
                                        {{ $order->status == 'pending' ? 'text-yellow-600' : ($order->status == 'completed' ? 'text-green-600' : 'text-red-600') }}">
                                        {{ ucfirst($order->status) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 text-sm text-center">Belum ada pesanan yang dibuat.</p>
            @endif
        </div>

        <!-- TAB: HISTORY -->
        <div x-show="tab === 'history'" class="bg-white rounded-lg shadow p-4 sm:p-6 text-center mt-6">
            <h2 class="text-lg sm:text-xl font-bold mb-2">History</h2>
            <p class="text-gray-500 text-sm">Belum ada riwayat aktivitas.</p>
        </div>
    </div>
</body>

</html>
