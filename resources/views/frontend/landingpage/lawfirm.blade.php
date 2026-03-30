@extends('layouts.app')

@section('title', 'Selamat Datang di LayananMu - Jambi')

@section('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .testimonial-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
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
        <!-- Grid pattern -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=" 60" height="60" viewBox="0 0 60 60"
            xmlns="http://www.w3.org/2000/svg" %3E%3Cg fill="none" fill-rule="evenodd" %3E%3Cg fill="%23ffffff"
            fill-opacity="0.03" %3E%3Cpath
            d="m36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]
            opacity-20"></div>

    </div>

    <!-- Main Content -->
    <div class="relative z-10">
        <section id="home" class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8">
            <div class="container mx-auto px-6 py-20">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="scroll-reveal">
                        <div class="inline-flex items-center bg-purple-100 text-purple-700 px-4 py-2 rounded-full mb-6">
                            <i class="fas fa-award mr-2"></i>
                            <span class="text-sm font-semibold">Terpercaya 10+ Tahun</span>
                        </div>
                        <h1 class="text-5xl md:text-6xl font-bold text-purple-900 mb-6 leading-tight">
                            Solusi Hukum <span class="text-blue-500">& Pendampingan</span>
                            untuk Anda
                        </h1>
                        <p class="text-xl text-purple-900 mb-8">
                            Pendampingan hukum lengkap untuk individu, perusahaan, dan klien internasional.
                            Pengalaman menangani kasus kompleks dengan tingkat memuaskan.
                        </p>
                        <div class="flex flex-wrap gap-4 mb-8">
                            <button onclick="scrollToSection('contact')"
                                class="gradient-bg text-white px-8 py-4 rounded-lg font-semibold hover:shadow-xl transform hover:scale-105 transition">
                                <i class="fas fa-phone-alt mr-2"></i>
                                Konsultasi Gratis
                            </button>
                            <button onclick="scrollToSection('services')"
                                class=" text-slate-700 border-2 border-purple-600 px-8 py-4 rounded-lg font-semibold hover:bg-purple-50 transition">
                                <i class="fas fa-info-circle mr-2"></i>
                                Lihat Layanan
                            </button>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="flex -space-x-2">
                                <img src="https://picsum.photos/seed/user1/40/40"
                                    class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                                <img src="https://picsum.photos/seed/user2/40/40"
                                    class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                                <img src="https://picsum.photos/seed/user3/40/40"
                                    class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                                <img src="https://picsum.photos/seed/user4/40/40"
                                    class="w-10 h-10 rounded-full border-2 border-white" alt="User">
                            </div>
                            <div>
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="text-sm text-gray-600">500+ Klien Puas</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative scroll-reveal">
                        <div class="float-animation">
                            <img src="https://picsum.photos/seed/lawyer/600/600" alt="Lawyer"
                                class="rounded-2xl shadow-2xl">
                        </div>
                        <div class="absolute -bottom-10 -left-10 bg-white p-4 rounded-xl shadow-xl">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-3 rounded-lg mr-3">
                                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold">Berhasil</p>
                                    <p class="text-sm text-gray-600">75% Kasus Dimenangkan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8 py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center scroll-reveal">
                        <div class="text-4xl font-bold text-purple-600 counter" data-target="500">0</div>
                        <p class="text-gray-600 mt-2">Klien Puas</p>
                    </div>
                    <div class="text-center scroll-reveal">
                        <div class="text-4xl font-bold text-purple-600 counter" data-target="95">0</div>
                        <p class="text-gray-600 mt-2">% Keberhasilan</p>
                    </div>
                    <div class="text-center scroll-reveal">
                        <div class="text-4xl font-bold text-purple-600 counter" data-target="50">0</div>
                        <p class="text-gray-600 mt-2">Pengacara Profesional</p>
                    </div>
                    <div class="text-center scroll-reveal">
                        <div class="text-4xl font-bold text-purple-600 counter" data-target="15">0</div>
                        <p class="text-gray-600 mt-2">Tahun Pengalaman</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8 py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 scroll-reveal">
                    <h2 class="text-4xl font-bold text-slate-600 mb-4">Layanan Kami</h2>
                    <p class="text-xl text-slate-600">Solusi hukum komprehensif untuk berbagai kebutuhan</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover scroll-reveal">
                        <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-briefcase text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-600 mb-4">Konsultasi Hukum</h3>
                        <p class="text-gray-600 mb-6">Konsultasi mendalam dengan advokat berpengalaman untuk semua
                            masalah hukum Anda.</p>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Konsultasi 24/7</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Analisis kasus gratis</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Strategi hukum optimal</li>
                        </ul>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover scroll-reveal">
                        <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-building text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-600 mb-4">Hukum Korporasi</h3>
                        <p class="text-gray-600 mb-6">Pendampingan hukum untuk perusahaan dari berbagai industri dan
                            skala.</p>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Due diligence</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>M&A & restrukturisasi</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Kepatuhan regulasi</li>
                        </ul>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover scroll-reveal">
                        <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-globe text-purple-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-600 mb-4">Hukum Internasional</h3>
                        <p class="text-gray-600 mb-6">Pendampingan khusus untuk WNA dan turis dengan isu hukum di
                            Indonesia.</p>
                        <ul class="space-y-2 text-gray-600">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Visa & imigrasi</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Investasi asing</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Multi-bahasa support</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Expertise Section -->
        <section id="expertise" class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8 py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="scroll-reveal">
                        <h2 class="text-4xl font-bold text-slate-700 mb-6">Mengapa Memilih Kami?</h2>
                        <p class="text-xl text-slate-700 mb-8">
                            Kami adalah tim profesional dengan dedikasi tinggi untuk memberikan solusi hukum terbaik.
                        </p>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-users text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-700 mb-2">Tim Berpengalaman</h4>
                                    <p class="text-gray-600">50+ pengacara dengan spesialisasi berbeda dan pengalaman
                                        15+ tahun</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-handshake text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-700 mb-2">Pendampingan WNA</h4>
                                    <p class="text-gray-600">Membantu WNA dan turis dengan isu hukum di Indonesia</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-shield-alt text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-700 mb-2">Kerahasiaan Terjamin</h4>
                                    <p class="text-gray-600">100% kerahasiaan dan perlindungan data klien</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="scroll-reveal">
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-white p-6 rounded-xl text-center">
                                    <i class="fas fa-certificate text-4xl text-purple-600 mb-3"></i>
                                    <p class="font-semibold text-slate-600">Sertifikasi Internasional</p>
                                </div>
                                <div class="bg-white p-6 rounded-xl text-center">
                                    <i class="fas fa-clock text-4xl text-purple-600 mb-3"></i>
                                    <p class="font-semibold text-slate-600">Layanan Terjangkau</p>
                                </div>
                                <div class="bg-white p-6 rounded-xl text-center">
                                    <i class="fas fa-trophy text-4xl text-purple-600 mb-3"></i>
                                    <p class="font-semibold text-slate-600">Praktisi Hukum Berpengalaman</p>
                                </div>
                                <div class="bg-white p-6 rounded-xl text-center">
                                    <i class="fas fa-chart-line text-4xl text-purple-600 mb-3"></i>
                                    <p class="font-semibold text-slate-600">95% Client Merasa Puas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials" class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8 py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16 scroll-reveal">
                    <h2 class="text-4xl font-bold text-slate-800 mb-4">Apa Kata Klien Kami</h2>
                    <p class="text-xl text-slate-600">Testimoni nyata dari mereka yang telah kami bantu</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="testimonial-card p-8 rounded-2xl scroll-reveal">
                        <div class="flex text-yellow-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-slate-700 mb-6 italic">
                            "Tim LayananMU Hukum sangat profesional dalam menangani kasus perusahaan kami.
                            Mereka berhasil menyelesaikan sengketa bisnis yang kompleks dengan hasil yang memuaskan."
                        </p>
                        <div class="flex items-center">
                            <img src="https://picsum.photos/seed/client1/50/50" class="w-12 h-12 rounded-full mr-4"
                                alt="Client">
                            <div>
                                <p class="text-slate-700 font-semibold">Budi Santoso</p>
                                <p class="text-sm text-slate-700">CEO, PT Maju Bersama</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card p-8 rounded-2xl scroll-reveal">
                        <div class="flex text-yellow-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-slate-700 mb-6 italic">
                            "Sebagai turis dari Australia, saya menghadapi masalah hukum yang cukup serius.
                            LayananMU Hukum memberikan pendampingan luar biasa dengan komunikasi yang jelas dalam bahasa
                            Inggris."
                        </p>
                        <div class="flex items-center">
                            <img src="https://picsum.photos/seed/client2/50/50" class="w-12 h-12 rounded-full mr-4"
                                alt="Client">
                            <div>
                                <p class="text-slate-700 font-semibold">Michael Johnson</p>
                                <p class="text-sm text-slate-700">WNA, Australia</p>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-card p-8 rounded-2xl scroll-reveal">
                        <div class="flex text-yellow-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">
                            "Pendampingan hukum untuk investasi perusahaan kami di Indonesia sangat membantu.
                            Mereka memahami regulasi lokal dan internasional dengan sempurna."
                        </p>
                        <div class="flex items-center">
                            <img src="https://picsum.photos/seed/client3/50/50" class="w-12 h-12 rounded-full mr-4"
                                alt="Client">
                            <div>
                                <p class="font-semibold">Sarah Chen</p>
                                <p class="text-sm text-gray-600">Director, Global Tech Inc</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8 py-20 gradient-bg">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-4xl font-bold text-white mb-6 scroll-reveal">
                    Tertarik dengan bantuan hukum kami ?
                </h2>
                <p class="text-xl text-white mb-8 scroll-reveal">
                    Konsultasi gratis dengan tim ahli kami sekarang juga
                </p>
                <div class="flex flex-wrap justify-center gap-4 scroll-reveal">
                    <button onclick="openWhatsApp()"
                        class="bg-transparent text-white border-2 border-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp Sekarang
                    </button>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="relative pb-20 lg:pb-32 px-4 sm:px-6 lg:px-8 py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12 scroll-reveal">
                        <h2 class="text-4xl font-bold text-slate-800 mb-4">Hubungi Kami</h2>
                    </div>
                    <div class="grid md:grid-cols-1 gap-8 items-center justify-center">
                        <div class="scroll-reveal">
                            <div class="bg-gray-50 p-8 rounded-2xl text-center">
                                <h3 class="text-2xl font-bold text-slate-800 mb-6">Informasi Kontak</h3>
                                <div class="space-y-4 text-center">
                                    <div class="flex items-center justify-center">
                                        <i class="fas fa-map-marker-alt text-purple-600 mr-4"></i>
                                        <p class="text-slate-700">Jl. Legal Pro No. 123, Jakarta Pusat</p>
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <i class="fas fa-phone text-purple-600 mr-4"></i>
                                        <p class="text-slate-700">+62 21 1234 5678</p>
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <i class="fas fa-envelope text-purple-600 mr-4"></i>
                                        <p class="text-slate-700">info@legalpro.id</p>
                                    </div>
                                    <div class="flex items-center justify-center">
                                        <i class="fas fa-clock text-purple-600 mr-4"></i>
                                        <p class="text-slate-700">Senin - Sabtu: 08:00 - 20:00</p>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <h4 class="font-semibold text-slate-800 mb-4">Ikuti Kami</h4>
                                    <div class="flex space-x-4 text-center justify-center">
                                        <a href="#"
                                            class="bg-purple-100 p-3 rounded-full hover:bg-purple-200 transition">
                                            <i class="fab fa-facebook-f text-purple-600"></i>
                                        </a>
                                        <a href="#"
                                            class="bg-purple-100 p-3 rounded-full hover:bg-purple-200 transition">
                                            <i class="fab fa-instagram text-purple-600"></i>
                                        </a>
                                        <a href="#"
                                            class="bg-purple-100 p-3 rounded-full hover:bg-purple-200 transition">
                                            <i class="fab fa-linkedin-in text-purple-600"></i>
                                        </a>
                                        <a href="#"
                                            class="bg-purple-100 p-3 rounded-full hover:bg-purple-200 transition">
                                            <i class="fab fa-youtube text-purple-600"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-balance-scale text-2xl mr-2"></i>
                        <span class="text-xl font-bold">LayananMU Hukum</span>
                    </div>
                    <p class="text-gray-400">Solusi hukum terpercaya untuk semua kebutuhan Anda</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Konsultasi Hukum</a></li>
                        <li><a href="#" class="hover:text-white transition">Hukum Korporasi</a></li>
                        <li><a href="#" class="hover:text-white transition">Hukum Internasional</a></li>
                        <li><a href="#" class="hover:text-white transition">Litigasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Tim Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Karir</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Dapatkan update hukum terbaru</p>
                    <form onsubmit="subscribeNewsletter(event)" class="flex">
                        <input type="email" placeholder="Email Anda" class="px-4 py-2 rounded-l-lg flex-1 text-gray-900 focus:outline-none border-0 outline-none"><button type="submit" class="bg-purple-600 px-4 py-2 rounded-r-lg hover:bg-purple-700 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 LayananMU Hukum. All rights reserved. | <a href="#" class="hover:text-white">Privacy Policy</a> | <a href="#" class="hover:text-white">Terms of Service</a></p>
            </div>
        </div>
    </footer>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Counter animation
    const counters = document.querySelectorAll('.counter');
    const speed = 200;

    const countUp = () => {
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(countUp, 10);
            } else {
                counter.innerText = target;
                if (counter.getAttribute('data-target') === '95') {
                    counter.innerText = target + '%';
                }
            }
        });
    };

    // Start counter when section is visible
    const counterObserver = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && entry.target.innerText === '0') {
                countUp();
            }
        });
    }, {
        threshold: 0.5
    });

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });

</script>
@endsection
