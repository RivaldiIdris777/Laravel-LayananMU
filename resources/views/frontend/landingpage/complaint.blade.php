@extends('layouts.app')

@section('title', 'Selamat Datang di LayananMu - Jambi')

@section('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, rgba(239, 13, 13, 1) 0%, #810404ff 100%);
    }

    /* WhatsApp Modal */
    #waModal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(4px);
    }
    #waModal.show {
        display: flex;
    }
    #waModal .modal-box {
        background: #fff;
        border-radius: 1.25rem;
        padding: 2rem;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.3);
        animation: modalIn 0.3s ease;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: translateY(30px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0)   scale(1); }
    }
    #waModal input,
    #waModal textarea {
        width: 100%;
        border: 1.5px solid #e2e8f0;
        border-radius: 0.625rem;
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        color: #1e293b;
        background: #f8fafc;
        outline: none;
        transition: border-color 0.2s;
    }
    #waModal input:focus,
    #waModal textarea:focus {
        border-color: #ef4444;
        background: #fff;
    }
    #waModal textarea {
        resize: vertical;
        min-height: 90px;
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
        <section id="home" class="gradient-bg text-white py-20">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-10 md:mb-0 fade-in">
                        <h1 class="text-4xl md:text-5xl font-bold mb-6">Pusat Layanan Pengaduan Mahasiswa</h1>
                        <p class="text-lg mb-8 text-purple-100">Sampaikan keluhan Anda dengan mudah dan cepat. Kami siap
                            membantu menyelesaikan permasalahan akademik Anda.</p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('chat-complaint') }}"
                                class="bg-amber-300 text-red-700 px-8 py-3 rounded-full font-semibold hover:bg-purple-50 transition transform hover:scale-105">
                                <i class="fas fa-comment-dots mr-2"></i> Ajukan Keluhan (Login Terlebih Dahulu)
                            </a>
                            <button onclick="openWaModal()"
                                class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-red-700 transition transform hover:scale-105">
                                <i class="fab fa-whatsapp mr-2"></i> Hubungi Via Whatsapp
                            </button>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center">
                        <img src="https://picsum.photos/seed/university-help/600/400.jpg" alt="University Support"
                            class="rounded-lg shadow-2xl">
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Section -->
    <section id="contact" class="py-16 bg-amber-400 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan Langsung?</h2>
                <p class="text-purple-100 max-w-2xl mx-auto">Hubungi kami melalui berbagai channel yang tersedia</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="bg-white bg-opacity-20 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <i class="text-red-700 fas fa-comment-dots  text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Via Chat Langsung</h3>
                    <p class="text-purple-100">Silahkan Klik Tombol Ajukan Keluhan Diatas</p>
                </div>
                <div class="text-center">
                    <div class="bg-white bg-opacity-20 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <i class="text-red-700 fab fa-whatsapp text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Via Whatsapp</h3>
                    <p class="text-purple-100">Silahkan Klik Tombol Via Whatsapp</p>
                </div>
                <div class="text-center">
                    <div class="bg-white bg-opacity-20 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <i class="text-red-700 fas fa-map-marker-alt text-2xl"></i>
                    </div>
                    <h3 class="font-semibold mb-2">Langsung ke PMB</h3>
                    <p class="text-purple-100">Jl. Kapten Pattimura, Simpang IV Sipin, Kec. Telanaipura, Kota Jambi, Jambi 36124</p>
                </div>
            </div>
        </div>
    </section>
    </div>
</div>

<!-- WhatsApp Modal -->
<div id="waModal" role="dialog" aria-modal="true" aria-labelledby="waModalTitle">
    <div class="modal-box">
        <!-- Header -->
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background:#25D366">
                    <i class="fab fa-whatsapp text-white text-xl"></i>
                </div>
                <h2 id="waModalTitle" class="text-lg font-bold text-slate-800">Hubungi via WhatsApp</h2>
            </div>
            <button onclick="closeWaModal()" class="text-slate-400 hover:text-red-500 transition text-xl leading-none">&times;</button>
        </div>

        <p class="text-sm text-slate-500 mb-5">Isi formulir berikut, pesan akan langsung dikirim ke WhatsApp Customer Service kami.</p>

        <!-- Form -->
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-900 mb-1" for="wa_nama">Nama Lengkap</label>
                <input id="wa_nama" type="text" placeholder="Contoh: Budi Santoso">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-900 mb-1" for="wa_npm">NPM</label>
                <input id="wa_npm" type="text" placeholder="Contoh: 2110101001">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-900 mb-1" for="wa_keluhan">Keluhan</label>
                <textarea id="wa_keluhan" placeholder="Jelaskan keluhan Anda secara singkat dan jelas..."></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex gap-3 mt-6">
            <button onclick="closeWaModal()"
                class="flex-1 py-2.5 rounded-full border border-slate-300 text-slate-600 font-medium hover:bg-slate-50 transition text-sm">
                Batal
            </button>
            <button onclick="sendToWhatsapp()"
                class="flex-1 py-2.5 rounded-full bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold transition text-sm flex items-center justify-center gap-2"                >
                <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
            </button>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const WA_NUMBER = '6282281119968'; // 0822 8111 9968

    function openWaModal() {
        document.getElementById('waModal').classList.add('show');
        document.getElementById('wa_nama').focus();
    }

    function closeWaModal() {
        document.getElementById('waModal').classList.remove('show');
    }

    // Close when clicking the backdrop
    document.getElementById('waModal').addEventListener('click', function(e) {
        if (e.target === this) closeWaModal();
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeWaModal();
    });

    function sendToWhatsapp() {
        const nama    = document.getElementById('wa_nama').value.trim();
        const npm     = document.getElementById('wa_npm').value.trim();
        const keluhan = document.getElementById('wa_keluhan').value.trim();

        if (!nama || !npm || !keluhan) {
            alert('Mohon lengkapi semua field terlebih dahulu.');
            return;
        }

        const pesan =
            `Halo, saya ingin menyampaikan keluhan:%0A%0A` +
            `*Nama*: ${encodeURIComponent(nama)}%0A` +
            `*NPM*: ${encodeURIComponent(npm)}%0A` +
            `*Keluhan*: ${encodeURIComponent(keluhan)}`;

        window.open(`https://wa.me/${WA_NUMBER}?text=${pesan}`, '_blank');
        closeWaModal();
    }
</script>
@endsection
