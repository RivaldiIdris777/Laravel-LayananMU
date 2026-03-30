@extends('layouts.app')

@section('title', 'Selamat Datang di LayananMu - Jambi')

@section('styles')
<style>
    .gradient-gold {
        background: linear-gradient(135deg, #D4AF37 0%, #F4E5C2 50%, #D4AF37 100%);
    }

</style>
@endsection

@section('content')
<div class="relative min-h-screen overflow-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 z-0">
        <!-- <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-purple-900/20 to-slate-900"></div> -->
        <!-- Floating particles -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-cyan-500/8 rounded-full blur-3xl animate-pulse delay-1000">
        </div>
        <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-pink-500/8 rounded-full blur-3xl animate-pulse delay-2000">
        </div>                
    </div>

    <!-- Main Content -->
    <div class="relative z-10">
        <!-- Hero Section -->
        <section class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/background_hero.png') }}'); 
                         background-size: cover; 
                         background-position: center; 
                         background-repeat: no-repeat;
                         background-attachment: fixed;">
            <!-- Floating decorative elements -->
            <div class="absolute top-8 right-8 w-3 h-3 bg-purple-400/40 rounded-full animate-bounce"></div>
            <div class="absolute top-12 right-16 w-2 h-2 bg-cyan-400/30 rounded-full animate-bounce delay-100"></div>
            <div class="absolute top-6 right-24 w-1 h-1 bg-pink-400/50 rounded-full animate-bounce delay-200"></div>

            <div class="max-w-7xl mx-auto">
                <!-- Hero Content -->
                <section class="hero max-w-7xl mx-auto px-4 py-12 md:py-20">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <!-- Kiri: teks + tombol -->
                        <div class="md:w-1/2 text-center md:text-left">
                            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-amber-300 mb-4">
                                PINEROMA<br><span class="text-lime-300">Parfum dengan kandungan organik alami dari buah
                                    nanas</span>
                            </h1>
                            <p class="text-yellow-300 mb-6 max-w-xl">
                                Inovasi terbaru dalam racikan berkualitas untuk produk parfume impian anda.
                            </p>

                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <a href="{{ url('/tujuan-1') }}"
                                    class="btn bg-yellow-500 text-yellow-550 inline-flex items-center justify-center">
                                    Pesan Sekarang
                                </a>
                                <a href="{{ url('/tujuan-2') }}"
                                    class="btn btn bg-lime-700 inline-flex items-center justify-center">
                                    Kenalan langsung di medsos kami
                                </a>
                            </div>
                        </div>

                        <!-- Kanan: gambar -->
                        <div class="md:w-1/2 w-full">
                            <!-- Opsi A: tag <img> (disarankan) -->
                            <div class="hero-image overflow-hidden ">
                                <img src="{{ asset('images/image_hero.png') }}" alt="Hero illustration"
                                    class="w-full h-64 md:h-96 object-cover">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="fade-in">
                        <h2 class="text-4xl text-amber-300 font-playfair font-bold mt-2 mb-6">
                            100% Original lokal dari Kota Jambi
                        </h2>
                        <p class="text-lime-600 mb-6 leading-relaxed">
                            Jambi Essence adalah parfum premium pertama dan satu-satunya yang diproduksi secara lokal di
                            kota Jambi.
                            Dibuat dengan cinta dan dedikasi tinggi, kami menghadirkan aroma khas yang mencerminkan
                            kekayaan budaya
                            dan alam Jambi dalam setiap tetesannya.
                        </p>
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <strong class="text-lime-500">100% Lokal Jambi</strong>
                                    <p class="text-amber-900">Diproduksi langsung di kota Jambi dengan bahan-bahan lokal
                                        pilihan</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <strong class="text-lime-500">Berkualitas Premium</strong>
                                    <p class="text-amber-900" class="text-gray-600">Standar internasional dengan
                                        sentuhan lokal yang autentik
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-yellow-500 mt-1 mr-3"></i>
                                <div>
                                    <strong class="text-lime-500">Eco-Friendly</strong>
                                    <p class="text-amber-900" class="text-gray-600">Kemasan ramah lingkungan dan proses
                                        produksi berkelanjutan
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button class="px-6 py-3 bg-black text-white rounded-full hover:bg-gray-800 transition">
                            Pelajari Lebih Lanjut <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                    <div class="relative float-animation max-w-md mx-auto">
                        <img src="{{ asset('images/pineroma/expo.jpg') }}" alt="Parfum Jambi Essence"
                            class="rounded-lg shadow-2xl w-full">
                        <div class="absolute -bottom-6 -left-6 bg-yellow-500 text-white p-6 rounded-lg shadow-xl">
                            <div class="text-3xl font-bold">2024</div>
                            <div class="text-sm">Tahun Berdiri</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ingredients Section -->
        <section id="ingredients" class="py-20 bg-gradient-to-br from-yellow-50 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 fade-in">
                    <h2 class="text-4xl text-amber-500 font-playfair font-bold mt-2 mb-4">
                        Komposisi Aroma Eksklusif
                    </h2>
                    <p class="text-amber-500 max-w-2xl mx-auto">
                        Setiap tetesan Jambi Essence mengandung bahan-bahan alami pilihan yang diracik dengan sempurna
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover-lift scent-note">
                        <div class="text-4xl mb-4 text-yellow-500">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="text-xl text-yellow-500 font-bold mb-3">Pineapple</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Nanas segar</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Vanilla</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Lemon Segar</li>
                        </ul>
                        <div class="mt-4 pt-4 border-t">
                            <p class="text-sm text-gray-500">Segar & Energik</p>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-lg hover-lift scent-note">
                        <div class="text-4xl mb-4 text-yellow-500">
                            <i class="fas fa-spa"></i>
                        </div>
                        <h3 class="text-xl text-yellow-500 font-bold mb-3">Middle Notes</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Mawar Jambi</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Jasmine Sambak</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Kayu Manis</li>
                        </ul>
                        <div class="mt-4 pt-4 border-t">
                            <p class="text-sm text-gray-500">Floral & Hangat</p>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-lg hover-lift scent-note">
                        <div class="text-4xl mb-4 text-yellow-500">
                            <i class="fas fa-tree"></i>
                        </div>
                        <h3 class="text-xl text-yellow-500 font-bold mb-3">Base Notes</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Sandalwood</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Vanili Madu</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Musk Putih</li>
                        </ul>
                        <div class="mt-4 pt-4 border-t">
                            <p class="text-sm text-gray-500">Wangi & Tahan Lama</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <div class="inline-block bg-green-100 px-6 py-3 rounded-full">
                        <i class="fas fa-certificate text-green-600 mr-2"></i>
                        <span class="text-green-800 font-semibold">100% Bahan Alami & Halal Certified</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Achievement Section -->
        <section id="achievement" class="py-20 bg-lime-700 text-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 fade-in">
                    <h2 class="text-4xl text-white font-playfair font-bold mt-2 mb-4">
                        Mendapatkan Pendanaan & Pengakuan
                    </h2>
                    <p class="text-white max-w-2xl mx-auto">
                        Prestasi yang membanggakan sebagai bukti kualitas dan potensi Jambi Essence
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                    <div class="space-y-6">
                        <div class="bg-amber-300 backdrop-blur-sm p-6 rounded-xl border border-yellow-500/30">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-trophy text-white"></i>
                                </div>
                                <h3 class="text-xl font-bold">Pendanaan Series A</h3>
                            </div>
                            <p class="text-white mb-3">
                                Berhasil mendapatkan pendanaan sebesar <span class="text-white font-bold">Rp 2.5
                                    Miliar</span>
                                dari investor lokal dan nasional
                            </p>
                            <div class="flex items-center text-sm text-gray-400">
                                <i class="fas fa-calendar mr-2"></i>
                                <span class="text-white">Februari 2024</span>
                            </div>
                        </div>

                        <div class="bg-amber-300 backdrop-blur-sm p-6 rounded-xl border border-yellow-500/30">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-award text-white"></i>
                                </div>
                                <h3 class="text-xl font-bold">Best Local Product 2024</h3>
                            </div>
                            <p class="text-white mb-3">
                                Terpilih sebagai produk lokal terbaik dalam <span class="text-white font-bold">Indonesia
                                    Beauty Awards</span>
                            </p>
                            <div class="flex items-center text-sm text-gray-400">
                                <i class="fas fa-calendar mr-2"></i>
                                <span class="text-white">Maret 2024</span>
                            </div>
                        </div>

                        <div class="bg-amber-300 backdrop-blur-sm p-6 rounded-xl border border-yellow-500/30">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-handshake text-white"></i>
                                </div>
                                <h3 class="text-xl font-bold">Kerjasama Distribusi</h3>
                            </div>
                            <p class="text-white mb-3">
                                Menjalin kerjasama dengan <span class="text-white font-bold">50+ mitra
                                    distribusi</span>
                                di seluruh Indonesia
                            </p>
                            <div class="flex items-center text-sm text-gray-400">
                                <i class="fas fa-calendar mr-2"></i>
                                <span class="text-white">April 2024</span>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <img src="{{ asset('images/pineroma/ojk.jpg') }}" alt="Penghargaan"
                            class="rounded-lg shadow-2xl">
                        <div
                            class="absolute -top-4 -right-4 bg-yellow-500 text-black p-4 rounded-lg shadow-xl animate-pulse">
                            <i class="fas fa-star text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Test Results Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 fade-in">
                    <h2 class="text-4xl text-amber-500 font-playfair font-bold mt-2 mb-4">
                        Teruji & Tersertifikasi
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Hasil uji Badan POM membuktikan kualitas dan keamanan Jambi Essence
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    <div
                        class="text-center p-6 bg-gradient-to-br from-yellow-50 to-white rounded-xl shadow-md hover-lift">
                        <div class="text-5xl font-bold text-yellow-600 mb-2">98%</div>
                        <div class="text-amber-700 font-semibold">Kemanan Kulit</div>
                        <div class="text-sm text-gray-500 mt-2">Dermatology Tested</div>
                    </div>
                    <div
                        class="text-center p-6 bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md hover-lift">
                        <div class="text-5xl font-bold text-blue-600 mb-2">0%</div>
                        <div class="text-blue-700 font-semibold">Alkohol Berbahaya</div>
                        <div class="text-sm text-gray-500 mt-2">Alcohol-Free</div>
                    </div>
                    <div
                        class="text-center p-6 bg-gradient-to-br from-purple-50 to-white rounded-xl shadow-md hover-lift">
                        <div class="text-5xl font-bold text-purple-600 mb-2">A+</div>
                        <div class="text-purple-700 font-semibold">Kualitas Premium</div>
                        <div class="text-sm text-gray-500 mt-2">Grade A Quality</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-20 bg-gradient-to-br from-yellow-50 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 fade-in">
                    <h2 class="text-4xl text-amber-500 font-playfair font-bold mt-2 mb-4">
                        Apa Kata Mereka ?
                    </h2>
                    <p class="text-amber-500 max-w-2xl mx-auto">
                        Ribuan pelanggan telah merasakan keistimewaan Jambi Essence
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div class="testimonial-card p-6 rounded-xl shadow-lg hover-lift">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/pineroma/testimoni1.jpg') }}" alt="User"
                                class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-bold text-amber-700">Sarah Putri</h4>
                                <div class="flex text-yellow-500 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-amber-700 italic">
                            "Parfumnya wanginya sangat elegan dan tahan lama! Bangga bisa menggunakan produk lokal dari
                            Jambi yang kualitasnya tidak kalah dengan merek internasional."
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-1"></i>Jambi City
                        </div>
                    </div>

                    <div class="testimonial-card p-6 rounded-xl shadow-lg hover-lift">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/pineroma/testimoni2.jpg') }}" alt="User"
                                class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-bold text-amber-700">Sabna</h4>
                                <div class="flex text-yellow-500 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-amber-700 italic">
                            "Sebagai pria, saya sangat suka aroma maskulin yang tidak terlalu menyengat. Jambi Essence
                            memberikan kesan profesional namun tetap elegan. Recommended!"
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-1"></i>Jakarta
                        </div>
                    </div>

                    <div class="testimonial-card p-6 rounded-xl shadow-lg hover-lift">
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('images/pineroma/testimoni4.jpg') }}" alt="User"
                                class="w-12 h-12 rounded-full mr-3">
                            <div>
                                <h4 class="font-bold text-amber-700">Hendra Kurniawan</h4>
                                <div class="flex text-yellow-500 text-sm">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-amber-700 italic">
                            "Sudah 6 bulan pakai Jambi Essence dan banyak teman yang tanya parfum apa yang saya pakai.
                            Wanginya unik dan memang beda dari yang lain. Top banget!"
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-map-marker-alt mr-1"></i>Surabaya
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <div class="inline-flex items-center space-x-4 bg-white px-6 py-3 rounded-full shadow-md">
                        <i class="fas fa-quote-left text-yellow-500"></i>
                        <span class="text-yellow-500">5000+ Testimoni Positif</span>
                        <i class="fas fa-quote-right text-yellow-500"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 gradient-gold">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl text-gray-950 font-playfair font-bold mb-6">
                    "Rasakan Keistimewaan Pineroma Essence"
                </h2>
                <p class="text-xl mb-8 text-gray-950 max-w-2xl mx-auto">
                    Dapatkan parfum original lokal pertama dari Jambi dengan harga spesial
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        class="px-8 py-4 bg-black text-white font-semibold rounded-full hover:bg-gray-800 transform hover:scale-105 transition">
                        <i class="fas fa-shopping-bag mr-2"></i>Beli Sekarang - Diskon 20%
                    </button>
                </div>
                <div class="mt-8 text-sm text-amber-700">
                    <i class="fas fa-truck mr-2"></i>Gratis Ongkir untuk Pembelian di sekitaran provinsi Jambi
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer id="contact" class="bg-amber-400 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mx-auto px-4">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-spray-can text-2xl text-white"></i>
                            <span class="text-xl font-bold font-playfair">Pineroma</span>
                        </div>
                        <p class="text-white">
                            Parfum premium lokal pertama dan satu-satunya dari kota Jambi
                        </p>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="text-white ">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            <a href="#" class="text-white hover:text-yellow-800 transition">
                                <i class="fab fa-facebook text-xl"></i>
                            </a>
                            <a href="#" class="text-white hover:text-yellow-800 transition">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                            <a href="#" class="text-white hover:text-yellow-800 transition">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li class="text-white"><a href="#" >Tentang Kami</a></li>
                            <li class="text-white"><a href="#" >Produk</a></li>
                            <li class="text-white"><a href="#" >Testimoni</a></li>
                            <li class="text-white"><a href="#" >Blog</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Kontak</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li class="text-white"><i class="fas fa-phone mr-2"></i>+62 812-3456-7890</li>
                            <li class="text-white"><i class="fas fa-envelope mr-2"></i>info@jambiesence.id</li>
                            <li class="text-white"><i class="fas fa-map-marker-alt mr-2"></i>Jambi, Indonesia</li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold mb-4">Newsletter</h4>
                        <p class="text-white mb-4">Dapatkan penawaran spesial dan info terbaru</p>
                        <div class="flex">
                            <input type="email" placeholder="Email Anda"
                                class="px-4 py-2 bg-gray-800 rounded-l-lg flex-1 text-white">
                            <button
                                class="px-4 py-2 bg-yellow-500 text-black rounded-r-lg hover:bg-yellow-600 transition">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-white">
                    <p>&copy; 2024 Pineroma. All rights reserved. Made with <i
                            class="fas fa-heart text-red-500"></i> in Jambi</p>
                </div>
            </div>
        </footer>

    </div>
</div>
@endsection
