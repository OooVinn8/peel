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

        <div class="max-w-6xl mx-auto mt-6 p-4 sm:p-6" x-data="{ tab: new URLSearchParams(window.location.search).get('tab') || 'personal' }">

            <!-- TAB BUTTONS -->
            <div class="flex flex-wrap justify-center md:justify-start space-x-4 border-b mb-6">
                <button @click="tab = 'personal'"
                    :class="tab === 'personal' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
                    class="pb-2 font-semibold text-sm sm:text-base">
                    Data Pribadi
                </button>

                <button @click="tab = 'history'"
                    :class="tab === 'history' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
                    class="pb-2 font-semibold text-sm sm:text-base">
                    History
                </button>
            </div>

            <!-- TAB PERSONAL -->
            <div x-show="tab === 'personal'" class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- USER INFO -->
                <div class="md:col-span-2 bg-white rounded-lg shadow p-4 sm:p-6">

                    <h2 class="text-lg sm:text-xl font-bold text-blue-900 mb-4">Data Pribadi</h2>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" value="{{ $user->username }}" readonly
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" value="{{ $user->email }}" readonly
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">No HP</label>
                            <input type="text" value="{{ $user->phone }}" readonly
                                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </form>

                    <!-- CHANGE PASSWORD COLLAPSIBLE -->
                    <div class="mt-8 border-t pt-6" x-data="{ open: false }">

                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-bold text-blue-900">Ubah Password</h2>

                            <button @click="open = !open"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow text-sm hover:bg-blue-700 transition flex items-center gap-2">
                                <span x-text="open ? '▲' : '▼'"></span>
                            </button>
                        </div>

                        <div x-show="open" x-transition.duration.300ms class="mt-5">

                            <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Password Lama</label>
                                    <input type="password" name="current_password"
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan password lama" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Password Baru</label>
                                    <input type="password" name="new_password"
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Masukkan password baru" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" name="new_password_confirmation"
                                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Ulangi password baru" required>
                                </div>

                                <button type="submit"
                                    class="w-full py-2.5 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                    Simpan Perubahan Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- PROFILE PICTURE -->
                <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center justify-center relative">

                    <h2 class="text-lg font-bold    text-blue-900 mb-4">Foto Profil</h2>

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

                    <p
                        class="mt-4 text-sm italic text-center {{ $user->profile_picture ? 'text-gray-700' : 'text-gray-500' }}">
                        {{ $user->profile_picture
                            ? 'Mantap! Foto profil sudah keren, lanjut jelajahi MakanDulu!'
                            : 'Belum upload foto nih, ayo biar profil makin kece di MakanDulu!' }}
                    </p>
                </div>
            </div>

            <!-- TAB HISTORY -->
            <div x-show="tab === 'history'" class="mt-6">
                @if ($histories->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">No</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Order ID</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Status</th>
                                    <th class="py-3 px-4 text-left text-sm font-semibold text-gray-600">Catatan</th>
                                    <th class="py-3 px-4 text-center text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($histories as $index => $history)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="py-3 px-4 text-sm text-gray-700 font-medium">{{ $index + 1 }}
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y, H:i') }}
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-700 font-mono">
                                            #MD{{ str_pad($history->id, 6, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="py-3 px-4 text-sm">
                                            @php
                                                $statusColors = [
                                                    'selesai' => 'bg-green-100 text-green-700',
                                                    'dibatalkan' => 'bg-red-100 text-red-700',
                                                    'default' => 'bg-yellow-100 text-yellow-700',
                                                ];
                                                $colorClass =
                                                    $statusColors[$history->status] ?? $statusColors['default'];
                                            @endphp
                                            <span
                                                class="px-3 py-1 text-xs font-semibold rounded-full {{ $colorClass }}">
                                                {{ ucfirst($history->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-700">{{ $history->notes ?? '-' }}</td>
                                        <td class="py-3 px-4 text-center">
                                            <a href="{{ route('history.show', $history->id) }}"
                                                class="inline-block px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-white shadow-md rounded-lg p-8 text-center">
                        <p class="text-gray-500 text-lg">Belum ada history pesanan.</p>
                    </div>
                @endif
            </div>

        </div>

    </body>

    </html>
