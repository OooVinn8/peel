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

  <div class="max-w-6xl mx-auto mt-10 p-4" x-data="{ tab: 'personal' }">

    <div class="flex space-x-6 border-b mb-6">
      <button @click="tab = 'personal'"
        :class="tab === 'personal' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
        class="pb-2 font-semibold">Data Pribadi</button>

      <button @click="tab = 'history'"
        :class="tab === 'history' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500'"
        class="pb-2 font-semibold">History</button>
    </div>

    <div x-show="tab === 'personal'" class="grid md:grid-cols-3 gap-6">
      <div class="md:col-span-2 bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-blue-900 mb-4">Data Pribadi</h2>
        <form class="space-y-4">

          <div>
            <label class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" value="{{ $user->username }}" readonly
              class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" value="{{ $user->email }}" readonly
              class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">No HP</label>
            <input type="text" value="{{ $user->phone }}" readonly
              class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
          </div>
        </form>
      </div>

      <div class="bg-white rounded-lg shadow p-6 flex flex-col items-center justify-center">
        <h2 class="text-lg font-bold mb-2">Foto Profil</h2>
        <p class="text-sm text-gray-500 mb-4">Ayo pakai foto biar keren</p>

        <div class="relative">
          <div class="w-32 h-32 rounded-full bg-gray-300"></div>
          <button
            class="absolute bottom-2 right-2 bg-blue-500 w-10 h-10 rounded-full text-white shadow-md hover:bg-blue-600 flex items-center justify-center">
            <img src="{{ asset('images/camera.png') }}" alt="Camera" class="w-5 h-5">
          </button>
        </div>
      </div>
    </div>
    <div x-show="tab === 'history'" class="bg-white rounded-lg shadow p-6 text-center">
      <h2 class="text-xl font-bold mb-2">History</h2>
     
    </div>

    <div x-show="tab === 'settings'" class="bg-white rounded-lg shadow p-6 text-cener">
    </div>

  </div>
</body>
</html>
