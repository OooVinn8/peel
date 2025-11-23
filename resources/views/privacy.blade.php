@extends('layouts.app')
@include('layouts.navbar')
@section('title', 'Kebijakan Privasi - MakanDulu')
@section('content')
    <link rel="icon" href="{{ asset('icon.ico') }}" type="image/x-icon">

    <section class="w-full bg-gray-50 text-gray-800">

        {{-- HERO --}}
        <div class="relative bg-blue-700">
            <div class="absolute inset-0 opacity-10">
                <img src="{{ asset('images/privacy-banner.jpg') }}" alt="Kebijakan Privasi" class="w-full h-full object-cover">
            </div>
            <div class="relative flex flex-col items-center justify-center text-center py-20 px-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-wide drop-shadow-md">
                    Kebijakan Privasi
                </h1>
                <p class="mt-4 text-blue-100 max-w-2xl">
                    Cara kami mengumpulkan, menggunakan, dan melindungi data Anda saat menggunakan layanan
                    <span class="font-semibold text-yellow-300">MakanDulu</span>.
                </p>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="mx-auto w-full md:w-11/12 lg:w-4/5 px-6 md:px-12 py-14">

            <div class="bg-white rounded-2xl shadow-md p-8 md:p-12 border-t-8 border-yellow-400">

                <p class="text-sm text-gray-500 mb-6">
                    <span class="font-semibold text-gray-700">Terakhir diperbarui:</span> 16 Oktober 2025
                </p>

                <div class="space-y-10 leading-relaxed">

                    {{-- Bagian 1 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Data yang Kami Kumpulkan</h2>
                        <p>
                            Kami mengumpulkan data yang Anda berikan secara langsung, seperti nama, alamat email, nomor
                            telepon, dan alamat pengiriman.
                            Selain itu, kami mencatat informasi pesanan Anda (menu, jumlah, catatan khusus). Data ini
                            membantu kami memberikan layanan yang cepat dan tepat.
                        </p>
                    </section>

                    {{-- Bagian 2 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Penggunaan Data</h2>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Mengelola dan memproses pesanan Anda dengan efisien.</li>
                            <li>Menghubungi Anda terkait status pesanan atau pembaruan layanan.</li>
                            <li>Meningkatkan kualitas layanan dan pengalaman pengguna.</li>
                            <li>Memenuhi kewajiban hukum dan menjaga keamanan platform.</li>
                        </ul>
                    </section>

                    {{-- Bagian 3 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Berbagi Data</h2>
                        <p>
                            Kami tidak menjual data pribadi Anda. Data hanya dibagikan dengan pihak ketiga untuk keperluan
                            pembayaran dan pengiriman. Semua pihak yang menerima data terikat pada perjanjian kerahasiaan
                            yang ketat.
                        </p>
                    </section>

                    {{-- Bagian 4 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Keamanan Data</h2>
                        <p>
                            Kami melindungi data Anda dengan langkah teknis dan prosedural, termasuk enkripsi, kontrol
                            akses, dan pembaruan sistem rutin. Meskipun demikian, tidak ada sistem yang 100% aman. Jika
                            terjadi pelanggaran keamanan signifikan, kami akan memberi tahu Anda secepat mungkin.
                        </p>
                    </section>

                    {{-- Bagian 5 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Hak Anda</h2>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Meminta akses atau salinan data pribadi.</li>
                            <li>Memperbaiki data yang salah atau tidak lengkap.</li>
                            <li>Menolak pemrosesan data untuk tujuan pemasaran.</li>
                        </ul>
                        <p class="mt-2 italic">
                            Untuk permintaan terkait data, silakan hubungi kami melalui kontak di bawah.
                        </p>
                    </section>

                    {{-- Bagian 6 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Anak-anak</h2>
                        <p class="relative">
                            Layanan kami tidak ditujukan untuk anak di bawah <b>15 tahun</b>. Jika Anda mengetahui adanya
                            data anak yang terkumpul, segera hubungi kami untuk tindakan lebih lanjut.
                        </p>
                    </section>

                    {{-- Bagian 7 --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Perubahan Kebijakan</h2>
                        <p>
                            Kami dapat memperbarui kebijakan ini kapan saja. Setiap perubahan besar akan diumumkan melalui
                            situs atau email resmi.
                            Tanggal “Terakhir diperbarui” menunjukkan versi yang berlaku.
                        </p>
                    </section>

                    {{-- Kontak --}}
                    <section>
                        <h2 class="text-2xl font-bold text-blue-700 mb-2">Kontak</h2>
                        <ul class="space-y-2">
                            <li><strong>Email:</strong> <a href=""
                                    class="text-blue-600 hover:underline">support@makandulu.id</a></li>
                            <li><strong>Telepon:</strong> <a href="" class="text-blue-600 hover:underline">+62
                                    812-3456-7890 </a></li>
                            <li><strong>Alamat:</strong> MakanDulu — Jl. Merdeka, Pontianak Kota, Kalimantan Barat</li>
                        </ul>
                    </section>

                    <hr class="my-8">

                    <p class="text-sm text-gray-600 text-center">
                        Dengan menggunakan layanan <span class="text-blue-600 font-semibold">Makan</span><span
                            class="text-yellow-500 font-semibold">Dulu</span>, Anda menyetujui pengumpulan dan penggunaan
                        informasi sesuai kebijakan ini.
                    </p>
                </div>

            </div>
        </div>

    </section>

    @include('layouts.footer')
@endsection
