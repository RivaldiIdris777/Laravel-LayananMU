@extends('layouts.app')

@section('title', 'OpenTrip Bersama Pendaki - LayananMU')

@section('styles')
<style>
    .hero-bg {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.9), rgba(16, 185, 129, 0.9)),
            url('https://picsum.photos/seed/kerinci-mountain/1920/1080.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .gallery-item {
        overflow: hidden;
        position: relative;
    }

    .gallery-item img {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .testimonial-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .float-animation {
        animation: float 3s ease-in-out infinite;
    }

    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .scroll-smooth {
        scroll-behavior: smooth;
    }

    .nav-blur {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }

</style>
@endsection

@section('content')
<div class="relative min-h-screen overflow-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <!-- <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-purple-900/20 to-slate-900"></div> -->
        <!-- Floating particles -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-cyan-500/8 rounded-full blur-3xl animate-pulse delay-1000">
        </div>
        <div class="absolute bottom-20 left-1/3 w-80 h-80 bg-pink-500/8 rounded-full blur-3xl animate-pulse delay-2000">
        </div>
        <!-- Grid pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60" viewBox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%23ffffff"
            fill-opacity="0.03" %3E%3Cpath
            d="m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"
            /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>

    </div>

    <!-- Main Content -->
    <div class="relative z-10">
        <!-- Hero Section -->
        <section id="home" class="hero-bg min-h-screen flex items-center">
            <div class="container mx-auto px-4 pt-20">
                <div class="max-w-3xl mx-auto text-center text-white">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">
                        Jelajahi & Mendaki Gunung <span class="text-yellow-300">Bersama Kami</span>
                    </h1>
                    <p class="text-xl mb-8 opacity-90">
                        Bergabunglah dengan mahasiswa kehutanan untuk petualangan tak terlupakan di puncak tertinggi
                        Sumatera
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button onclick="scrollToSection('services')"
                            class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-full font-semibold hover:bg-yellow-300 transition transform hover:scale-105">
                            <i class="fas fa-hiking mr-2"></i> Mulai Petualangan
                        </button>
                        <a href=""
                            class="bg-white text-yellow-900 px-8 py-4 rounded-full font-semibold hover:bg-yellow-300 transition transform hover:scale-105">
                            <i class="fab fa-instagram mr-2"></i> Kunjungi Instagram Kami
                        </a>
                    </div>
                    <div class="mt-12 grid grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold">500+</div>
                            <div class="text-sm opacity-80">Peserta Puas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold">15+</div>
                            <div class="text-sm opacity-80">Paket Wisata</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold">98%</div>
                            <div class="text-sm opacity-80">Rating Kepuasan</div>
                        </div>
                    </div>
                </div>
            </div>            
        </section>

        <!-- Services Section -->
        <section id="services" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 gradient-text">Layanan Petualangan Kami</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Nikmati berbagai aktivitas seru yang dipandu langsung oleh mahasiswa kehutanan profesional
                    </p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <!-- Mountain Climbing -->
                    <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-mountain text-white text-6xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl text-slate-500 font-bold mb-2">Pendakian Gunung</h3>
                            <p class="text-gray-600 mb-4">Taklukkan puncak Gunung Kerinci dengan rute aman dan
                                pemandangan spektakuler</p>
                            <ul class="text-sm text-gray-500 space-y-1">
                                <li><i class="fas fa-check text-green-500 mr-2"></i>3 Hari 2 Malam</li>
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Bersama Tim dan Pemandu</li>
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Perlengkapan Disediakan (Tenda, Matras, Cooking Set)</li>
                            </ul>
                            <div class="mt-4">
                                <span class="text-2xl font-bold text-green-600">Rp 1.5jt</span>
                                <span class="text-gray-500">/orang</span>
                            </div>
                            <ul class="text-sm text-gray-500 space-y-1 mt-3">
                                <li><i class="fas fa-close text-red-500 mr-2"></i>Belum Termasuk Tiket Transport dan Makan</li>                                
                            </ul>
                        </div>
                    </div>
                                    
                    <!-- Conservation -->
                    <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                        <div
                            class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                            <i class="fas fa-tree text-white text-6xl"></i>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl text-slate-500 font-bold mb-2">Konservasi Alam</h3>
                            <p class="text-gray-600 mb-4">Ikut serta dalam pelestarian hutan dan penanaman pohon bersama
                                kami</p>
                            <ul class="text-sm text-gray-500 space-y-1">
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Edukasi Lingkungan</li>
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Planting Trees</li>
                                <li><i class="fas fa-check text-green-500 mr-2"></i>Certificate</li>
                            </ul>
                            <div class="mt-4">
                                <span class="text-2xl font-bold text-green-600">Rp 300k</span>
                                <span class="text-gray-500">/orang</span>
                            </div>
                            <ul class="text-sm text-gray-500 space-y-1 mt-3">
                                <li><i class="fas fa-close text-red-500 mr-2"></i>Belum Termasuk Tiket Transport dan Makan</li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-slate-900 text-4xl font-bold mb-4">Dokumentasi Petualangan</h2>
                    <p class="text-slate-600">Bukti nyata pengalaman seru bersama mahasiswa kehutanan</p>
                </div>

                <!-- Gallery Filter -->
                <div class="flex justify-center mb-8 flex-wrap gap-2">
                    <button class="filter-btn active px-6 py-2 rounded-full bg-green-600 text-white"
                        data-filter="all">Semua</button>
                    <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300"
                        data-filter="mountain">Gunung</button>
                    <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300"
                        data-filter="rafting">Rafting</button>
                    <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300"
                        data-filter="climbing">Climbing</button>
                    <button class="filter-btn px-6 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300"
                        data-filter="conservation">Konservasi</button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="gallery-grid">
                    <!-- Gallery Items -->
                    <div class="gallery-item relative rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="mountain">
                        <img src="https://picsum.photos/seed/kerinci-summit/400/300.jpg" alt="Puncak Kerinci"
                            class="w-full h-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition flex items-end p-4">
                            <span class="text-white font-semibold">Puncak Kerinci - 3.805m</span>
                        </div>
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="mountain">
                        <img src="https://picsum.photos/seed/kerinci-camping/400/300.jpg" alt="Camping"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="rafting">
                        <img src="https://picsum.photos/seed/rafting-kerinci/400/300.jpg" alt="Rafting"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="rafting">
                        <img src="https://picsum.photos/seed/river-adventure/400/300.jpg" alt="Sungai"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="climbing">
                        <img src="https://picsum.photos/seed/rock-climbing/400/300.jpg" alt="Panjat Tebing"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="climbing">
                        <img src="https://picsum.photos/seed/climbing-team/400/300.jpg" alt="Team Climbing"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="conservation">
                        <img src="https://picsum.photos/seed/tree-planting/400/300.jpg" alt="Menanam Pohon"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="conservation">
                        <img src="https://picsum.photos/seed/forest-conservation/400/300.jpg" alt="Konservasi Hutan"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="mountain">
                        <img src="https://picsum.photos/seed/sunrise-kerinci/400/300.jpg" alt="Sunrise"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="mountain">
                        <img src="https://picsum.photos/seed/kerinci-team/400/300.jpg" alt="Team Photo"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="rafting">
                        <img src="https://picsum.photos/seed/rafting-group/400/300.jpg" alt="Group Rafting"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="gallery-item rounded-lg overflow-hidden shadow-lg cursor-pointer"
                        data-category="conservation">
                        <img src="https://picsum.photos/seed/education-forest/400/300.jpg" alt="Edukasi"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4">Apa Kata Mereka?</h2>
                    <p class="text-gray-600">Testimoni dari para peserta yang telah bergabung</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow-lg p-6 relative">
                        <div class="absolute -top-4 left-6">
                            <i class="fas fa-quote-left text-3xl text-green-500"></i>
                        </div>
                        <div class="flex items-center mb-4">
                            <img src="https://picsum.photos/seed/user1/100/100.jpg" alt="User"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Ahmad Rizki</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">
                            "Pendakian ke Kerinci bersama Open Trip luar biasa! Pemandu sangat profesional dan
                            berpengalaman. Safety selalu diutamakan. Recommended!"
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>2 bulan yang lalu
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 relative">
                        <div class="absolute -top-4 left-6">
                            <i class="fas fa-quote-left text-3xl text-green-500"></i>
                        </div>
                        <div class="flex items-center mb-4">
                            <img src="https://picsum.photos/seed/user2/100/100.jpg" alt="User"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Sarah Putri</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">
                            "Arung jeramnya seru banget! Instruktur sabar dan selalu memastikan kita aman. Pengalaman
                            tak terlupakan bersama teman-teman baru!"
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>1 bulan yang lalu
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 relative">
                        <div class="absolute -top-4 left-6">
                            <i class="fas fa-quote-left text-3xl text-green-500"></i>
                        </div>
                        <div class="flex items-center mb-4">
                            <img src="https://picsum.photos/seed/user3/100/100.jpg" alt="User"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-semibold">Budi Santoso</h4>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">
                            "Program konservasinya sangat bermakna! Selain berpetualang, kita juga ikut menjaga alam.
                            Tim mahasiswa kehutanan sangat inspiratif!"
                        </p>
                        <div class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>3 minggu yang lalu
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Conservation Section -->
        <section id="conservation" class="py-20 bg-gradient-to-br from-green-50 to-emerald-50">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-slate-900 text-4xl font-bold mb-6">Bersama Lestarikan Alam</h2>
                        <p class="text-slate-600 mb-6">
                            Sebagai mahasiswa kehutanan, kami tidak hanya menawarkan petualangan seru,
                            tetapi juga berkomitmen untuk melestarikan kekayaan alam Gunung Kerinci.
                            Setiap perjalanan Anda turut berkontribusi pada program konservasi kami.
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <i class="fas fa-seedling text-green-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-slate-600 font-semibold mb-1">Penanaman 1000 Pohon/Tahun</h4>
                                    <p class="text-slate-600 text-sm">Setiap peserta berkontribusi menanam 5 pohon</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-recycle text-green-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-slate-600 font-semibold mb-1">Zero Waste Program</h4>
                                    <p class="text-slate-600 text-sm">Mengurangi sampah plastik di area pendakian</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-graduation-cap text-green-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="text-slate-600 font-semibold mb-1">Edukasi Masyarakat Lokal</h4>
                                    <p class="text-slate-600 text-sm">Memberikan pemahaman pentingnya konservasi</p>
                                </div>
                            </div>
                        </div>
                        <button
                            class="mt-8 bg-green-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-green-700 transition">
                            <i class="fas fa-hands-helping mr-2"></i> Dukung Konservasi
                        </button>
                    </div>
                    <div class="relative">
                        <img src="https://picsum.photos/seed/conservation-team/600/400.jpg" alt="Conservation"
                            class="rounded-xl shadow-2xl">
                        <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-xl shadow-lg">
                            <div class="text-3xl font-bold text-green-600">2,500+</div>
                            <div class="text-gray-600">Pohon Ditanam</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-20 bg-gray-900 text-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4">Siap Berpetualang?</h2>
                    <p class="text-gray-400">Hubungi kami sekarang dan dapatkan penawaran spesial!</p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-gray-800 rounded-xl p-8">
                        <form id="contact-form" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium mb-2">Nama Lengkap</label>
                                    <input type="text" required
                                        class="w-full px-4 py-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white"
                                        placeholder="John Doe">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-2">Email</label>
                                    <input type="email" required
                                        class="w-full px-4 py-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white"
                                        placeholder="john@example.com">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Pilih Paket</label>
                                <select
                                    class="w-full px-4 py-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white">
                                    <option>Pendakian Gunung Kerinci</option>
                                    <option>Arung Jeram Sungai Kerinci</option>
                                    <option>Panjat Tebing</option>
                                    <option>Program Konservasi</option>
                                    <option>Paket Lengkap (All In)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Tanggal Keberangkatan</label>
                                <input type="date" required
                                    class="w-full px-4 py-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-2">Pesan</label>
                                <textarea rows="4"
                                    class="w-full px-4 py-3 bg-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white"
                                    placeholder="Ceritakan kami tentang petualangan impian Anda..."></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-green-600 text-white py-4 rounded-lg font-semibold hover:bg-green-700 transition transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Pesan
                            </button>
                        </form>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6 mt-8">
                        <div class="text-center">
                            <i class="fas fa-phone text-3xl text-green-500 mb-4"></i>
                            <p class="font-semibold">Telepon</p>
                            <p class="text-gray-400">+XX XXX-XXXX-XXXX</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-envelope text-3xl text-green-500 mb-4"></i>
                            <p class="font-semibold">Email</p>
                            <p class="text-gray-400">example@example.com</p>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt text-3xl text-green-500 mb-4"></i>
                            <p class="font-semibold">Alamat</p>
                            <p class="text-gray-400">Jambi, Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-black text-white py-8">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center space-x-2 mb-4 md:mb-0">
                        <i class="fas fa-mountain text-green-600 text-2xl"></i>
                        <span class="text-xl font-bold">Open Trip</span>
                    </div>
                    <div class="flex space-x-6">
                        <a href="#" class="hover:text-green-500 transition"><i class="fab fa-facebook text-xl"></i></a>
                        <a href="#" class="hover:text-green-500 transition"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="hover:text-green-500 transition"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="hover:text-green-500 transition"><i class="fab fa-youtube text-xl"></i></a>
                    </div>
                </div>
                <div class="text-center mt-6 pt-6 border-t border-gray-800 text-gray-400">
                    <p>&copy; 2024 ForestAdvent. All rights reserved. | Powered by Mahasiswa Kehutanan</p>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Navbar Scroll Effect
    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('nav-blur', 'shadow-lg');
        } else {
            navbar.classList.remove('nav-blur', 'shadow-lg');
        }
    });

    // Smooth Scroll
    function scrollToSection(sectionId) {
        document.getElementById(sectionId).scrollIntoView({
            behavior: 'smooth'
        });
    }

    // Gallery Filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('bg-green-600', 'text-white');
                b.classList.add('bg-gray-200', 'text-gray-700');
            });
            btn.classList.remove('bg-gray-200', 'text-gray-700');
            btn.classList.add('bg-green-600', 'text-white');

            // Filter items
            const filter = btn.dataset.filter;
            galleryItems.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 10);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');

    document.querySelectorAll('.gallery-item').forEach(item => {
        item.addEventListener('click', () => {
            const img = item.querySelector('img');
            lightboxImg.src = img.src;
            lightbox.classList.remove('hidden');
        });
    });

    function closeLightbox() {
        lightbox.classList.add('hidden');
    }

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    // Contact Form
    document.getElementById('contact-form').addEventListener('submit', (e) => {
        e.preventDefault();
        // Show success message
        const button = e.target.querySelector('button[type="submit"]');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-2"></i> Pesan Terkirim!';
        button.classList.add('bg-green-700');

        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-700');
            e.target.reset();
        }, 3000);
    });

    // Play Video (Placeholder)
    function playVideo() {
        alert('Video akan segera tersedia! Hubungi kami untuk informasi lebih lanjut.');
    }

    // Animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(20px)';
        section.style.transition = 'all 0.6s ease-out';
        observer.observe(section);
    });

</script>
@endsection
