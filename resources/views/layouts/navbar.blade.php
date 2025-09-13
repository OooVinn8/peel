<nav class="flex items-center justify-between px-6 py-4 bg-white border-b shadow-md">

    <div class="flex items-center">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
    </div>

    <div class="flex-1 flex justify-center space-x-8 font-medium">
        <a href="{{ url('/') }}"
            class="{{ Request::is('/') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
            Beranda
        </a>

        <a href="{{ url('/menu') }}"
            class="{{ Request::is('menu') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
            Menu
        </a>

        <a href="{{ url('/aboutUs') }}"
            class="{{ Request::is('aboutUs') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
            Tentang Kami
        </a>
    </div>


    <div class="flex items-center space-x-4">
        @if(session()->has('user_id'))
        <a href="{{ url('/cart') }}"
            class="flex items-center space-x-2 hover:opacity-80 transition">

            <img src="{{ asset('images/cart.png') }}" alt="Keranjang" class="w-6 h-6">
        </a>

        <div class="relative">
            <button id="profileBtn"
                class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 focus:outline-none">
                {{ strtoupper(substr(session('username'),0,1)) }}
            </button>

            <div id="dropdownMenu"
                class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg hidden">
                <a href="{{ url('/profile') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>

                <form action="{{ route('logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">Logout
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="flex items-center space-x-3">
            <a href="{{ url('/login') }}"
                class="px-5 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Masuk
            </a>

            <a href="{{ url('/register') }}"
                class="px-5 py-2 border border-blue-600 text-black font-bold rounded-lg hover:bg-blue-50 transition">
                Daftar
            </a>
        </div>
        @endif
    </div>

</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const profileBtn = document.getElementById("profileBtn");
        const dropdownMenu = document.getElementById("dropdownMenu");

        if (profileBtn && dropdownMenu) {
            profileBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle("hidden");
            });

            document.addEventListener("click", function(e) {
                if (!dropdownMenu.classList.contains("hidden") && !profileBtn.contains(e.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        }
    });
</script>