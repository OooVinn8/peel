<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MakanDulu - @yield('title')</title>
    <link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <script src="{{ asset('js/admin.js') }}"></script>
</head>

<body class="bg-gray-100">
    <div class="flex">
        <aside
            class="fixed top-0 left-0 h-screen w-[300px] bg-white border-r border-gray-200 flex flex-col justify-between shadow-md">
            <div>
                <div class="p-6 flex items-center justify-center border-b border-gray-200">
                    <img src="{{ asset('images/logo.png') }}" alt="MakanDulu" class="h-12 object-contain">
                </div>

                <nav class="mt-6 space-y-2 px-4 overflow-y-auto flex-1">
                    <a href="{{ url('/admin') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition {{ request()->is('admin') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <img src="{{ asset('admin_images/dashboard.png') }}" class="h-6 w-6" alt="Dashboard">
                        <span class="text-base font-medium">Dashboard</span>
                    </a>

                    <a href="{{ url('/admin/orders') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition {{ request()->is('admin/orders*') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <img src="{{ asset('admin_images/pesanan.png') }}" class="h-6 w-6" alt="Pesanan">
                        <span class="text-base font-medium">Pesanan</span>
                    </a>

                    <a href="{{ url('/admin/products') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition {{ request()->is('admin/products*') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <img src="{{ asset('admin_images/menu.png') }}" class="h-6 w-6" alt="Menu">
                        <span class="text-base font-medium">Menu</span>
                    </a>

                    <a href="{{ url('/admin/categories') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition {{ request()->is('admin/categories*') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <img src="{{ asset('admin_images/kategori.png') }}" class="h-6 w-6" alt="Kategori">
                        <span class="text-base font-medium">Kategori</span>
                    </a>

                    <a href="{{ url('/admin/users') }}"
                        class="flex items-center gap-4 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-100 hover:text-blue-600 transition {{ request()->is('admin/users*') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <img src="{{ asset('admin_images/user.png') }}" class="h-6 w-6" alt="Pengguna">
                        <span class="text-base font-medium">Pengguna</span>
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-gray-200 text-center" >
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah kamu yakin ingin logout?')"
                        class="w-full py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition font-semibold">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-[300px] bg-gray-50 p-10 min-h-screen">
            <div class="flex justify-between items-center mb-5">
                <div>
                    <h1 class="text-3xl font-bold text-black">@yield('title')</h1>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
