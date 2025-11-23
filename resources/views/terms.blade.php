@extends('layouts.app')
@include('layouts.navbar')
@section('title', 'Syarat & Ketentuan - MakanDulu')
@section('content')
    <link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">

    <section class="w-full bg-gray-50 text-gray-800">

        {{-- HERO --}}
        <div class="relative bg-blue-700">
            <div class="absolute inset-0 opacity-10">
                <img src="{{ asset('images/terms-banner.jpg') }}" alt="Syarat dan Ketentuan"
                    class="w-full h-full object-cover">
            </div>
            <div class="relative flex flex-col items-center justify-center text-center py-20 px-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-wide drop-shadow-md">
                    Syarat & Ketentuan Pengguna
                </h1>
                <p class="mt-4 text-blue-100 max-w-2xl">
                    Aturan penggunaan yang berlaku saat kamu menggunakan layanan
                    <span class="font-semibold text-yellow-300">MakanDulu</span>.
                </p>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="mx-auto w-full md:w-11/12 lg:w-4/5 px-6 md:px-12 py-14">

            <div class="bg-white rounded-2xl shadow-md p-8 md:p-12 border-t-8 border-blue-500">

                <p class="text-sm text-gray-500 mb-6">
                    <span class="font-semibold text-gray-700">Terakhir diperbarui:</span> {{ now()->format('d F Y') }}
                </p>

                <div class="space-y-10 leading-relaxed">

                    {{-- Bagian 1 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">1. Penerimaan Ketentuan</h2>
                        <p>
                            Dengan menggunakan aplikasi atau layanan MakanDulu, kamu dianggap telah membaca, memahami, dan
                            menyetujui syarat & ketentuan ini. Jika kamu tidak setuju, silakan hentikan penggunaan layanan.
                        </p>
                    </section>

                    {{-- Bagian 2 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">2. Penggunaan Layanan</h2>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Kamu wajib memberikan data yang benar dan valid.</li>
                            <li>Dilarang menyalahgunakan fitur atau merugikan pengguna lain.</li>
                            <li>Tidak diperbolehkan melakukan tindakan palsu, spam, atau penipuan.</li>
                        </ul>
                    </section>

                    {{-- Bagian 3 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">3. Pemesanan & Pembayaran</h2>
                        <p>
                            Pesanan yang sudah dikonfirmasi tidak dapat dibatalkan. Semua pembayaran diproses melalui mitra
                            pembayaran resmi dan aman.
                        </p>
                    </section>

                    {{-- Bagian 4 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">4. Konten & Kepemilikan</h2>
                        <p>
                            Semua konten dalam platform ini, termasuk desain, teks, logo, dan fitur, merupakan hak cipta
                            MakanDulu. Dilarang menyalin, distribusi, atau menggunakan tanpa izin.
                        </p>
                    </section>

                    {{-- Bagian 5 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">5. Pembaruan Layanan</h2>
                        <p>
                            Kami dapat memperbarui fitur, tampilan, atau sistem kapan saja tanpa pemberitahuan sebelumnya
                            demi pengalaman pengguna yang lebih baik.
                        </p>
                    </section>

                    {{-- Bagian 6 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">6. Penangguhan Akun</h2>
                        <p>
                            Kami berhak menonaktifkan akun pengguna yang melanggar ketentuan, melakukan penipuan, atau
                            merugikan platform.
                        </p>
                    </section>

                    {{-- Bagian 7 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">7. Batas Tanggung Jawab</h2>
                        <p>
                            Kami tidak bertanggung jawab atas kerugian yang timbul akibat kesalahan teknis, koneksi, atau
                            penggunaan layanan yang tidak sesuai ketentuan.
                        </p>
                    </section>

                    {{-- Bagian 8 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">8. Perubahan Syarat</h2>
                        <p>
                            Syarat & ketentuan ini dapat diperbarui sewaktu-waktu. Pengguna disarankan memeriksa halaman ini
                            secara berkala.
                        </p>
                    </section>

                    {{-- Kontak --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Kontak</h2>
                        <ul class="space-y-2">
                            <li><strong>Email:</strong> <a href="mailto:support@makandulu.id"
                                    class="text-blue-600 hover:underline">support@makandulu.id</a></li>
                            <li><strong>Telepon:</strong> <a href="tel:+6281234567890"
                                    class="text-blue-600 hover:underline">+62 812-3456-7890</a></li>
                            <li><strong>Alamat:</strong> MakanDulu — Jl. Merdeka, Pontianak Kota, Kalimantan Barat</li>
                        </ul>
                    </section>

                    <hr class="my-8">

                    <p class="text-sm text-gray-600 text-center">
                        Dengan menggunakan layanan <span class="text-blue-600 font-semibold">Makan</span><span
                            class="text-yellow-500 font-semibold">Dulu</span>, Anda setuju mengikuti seluruh aturan yang
                        berlaku dan menggunakan layanan dengan cara yang benar.
                </div>

            </div>
        </div>

    </section>

    @include('layouts.footer')
@endsection
