@extends('layouts.app')

@section('title', 'Cek Data Alumni - LayananMU')

@section('styles')
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    .id-card-inner {
        background: white;
        border-radius: 12px;
        position: relative;
        overflow: hidden;
        aspect-ratio: 1.586;
        /* Standard ID card ratio */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .id-card-header {
        background: linear-gradient(90deg, #1e3a8a 0%, #3730a3 100%);
        position: relative;
    }

    .id-card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #fbbf24 0%, #f59e0b 100%);
    }

    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .card-hover:hover {
        transform: translateY(-8px) rotate(-1deg) scale(1.02);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .status-badge {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.9);
    }

    .modal-backdrop {
        backdrop-filter: blur(5px);
    }

    .graduate-icon-bg {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    }

    .id-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%239C92AC' fill-opacity='0.03'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");
    }

    .landscape-card {
        min-height: 200px;
    }

    .photo-section {
        background: #f8fafc;
        border-right: 1px solid #e5e7eb;
    }

</style>
@endsection

@section('content')
<div class="relative min-h-screen overflow-hidden">
    <div class="relative z-10">
        <section class="container mx-auto px-4 py-6">
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex flex-wrap gap-3 items-center">
                    <span class="text-slate-700 font-semibold">Filter Jurusan:</span>
                    <button onclick="filterByMajor('all')"
                        class="major-btn px-4 py-2 rounded-full bg-blue-600 text-white transition-all hover:bg-blue-700">
                        Semua
                    </button>
                    <button onclick="filterByMajor('Ekonomi Pembangunan')"
                        class="major-btn px-4 py-2 rounded-full bg-gray-200 text-slate-700 transition-all hover:bg-gray-300">
                        Ekonomi Pembangunan
                    </button>
                    <button onclick="filterByMajor('Manajemen')"
                        class="major-btn px-4 py-2 rounded-full bg-gray-200 text-slate-700 transition-all hover:bg-gray-300">
                        Manajemen
                    </button>                    
                    <button onclick="filterByMajor('Teknik Informatika')"
                        class="major-btn px-4 py-2 rounded-full bg-gray-200 text-slate-700 transition-all hover:bg-gray-300">
                        Teknik Informatika
                    </button>
                    <button onclick="filterByMajor('Sistem Informasi')"
                        class="major-btn px-4 py-2 rounded-full bg-gray-200 text-slate-700 transition-all hover:bg-gray-300">
                        Sistem Informasi
                    </button>                    
                    <!-- Filter Status -->
                    <div class="ml-auto flex items-center gap-2">
                        <span class="text-slate-700 font-semibold">Status:</span>
                        <select id="statusFilter" onchange="filterByStatus()"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="all">Semua Status</option>
                            <option value="Bekerja">Bekerja</option>
                            <option value="Studi Lanjut">Studi Lanjut</option>
                            <option value="Mencari Kerja">Mencari Kerja</option>
                            <option value="Wirausaha">Wirausaha</option>
                        </select>
                    </div>

                    <!-- Sort Dropdown -->
                    <div>
                        <select id="sortSelect" onchange="sortAlumni()"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="default">Urutkan</option>
                            <option value="name-asc">Nama A-Z</option>
                            <option value="year-desc">Tahun Lulus Terbaru</option>
                            <option value="year-asc">Tahun Lulus Terlama</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Cards -->
        <section class="container mx-auto px-4 py-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <i class="fas fa-id-badge text-blue-600 text-2xl mb-2"></i>
                    <p class="text-slate-600 text-sm">Total Alumni</p>
                    <p class="text-2xl font-bold text-slate-800" id="totalAlumni">0</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <i class="fas fa-briefcase text-green-600 text-2xl mb-2"></i>
                    <p class="text-slate-600 text-sm">Sudah Bekerja</p>
                    <p class="text-2xl font-bold text-slate-800" id="workingCount">0</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <i class="fas fa-user-graduate text-purple-600 text-2xl mb-2"></i>
                    <p class="text-slate-600 text-sm">Studi Lanjut</p>
                    <p class="text-2xl font-bold text-slate-800" id="studyingCount">0</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4 text-center">
                    <i class="fas fa-rocket text-orange-600 text-2xl mb-2"></i>
                    <p class="text-slate-600 text-sm">Wirausaha</p>
                    <p class="text-2xl font-bold text-slate-800" id="entrepreneurCount">0</p>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-6">
            <!-- Loading Indicator -->
            <div id="loadingIndicator" class="hidden">
                <div class="flex justify-center items-center py-12">
                    <div class="relative">
                        <div class="w-16 h-16 border-4 border-blue-200 rounded-full animate-spin"></div>
                        <div
                            class="w-16 h-16 border-4 border-blue-600 rounded-full animate-spin border-t-transparent absolute top-0 left-0">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ID Cards Grid -->
            <div id="alumniGrid" class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                <!-- ID Cards will be inserted here by JavaScript -->
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-8">
                <button id="loadMoreBtn" onclick="loadMoreAlumni()"
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Muat Lebih Banyak
                </button>
            </div>

            <!-- No Results Message -->
            <div id="noResults" class="hidden text-center py-12">
                <i class="fas fa-search text-6xl text-slate-300 mb-4"></i>
                <p class="text-xl text-slate-500">Tidak ada alumni yang ditemukan</p>
                <p class="text-slate-400 mt-2">Coba ubah kata kunci atau filter Anda</p>
            </div>
        </main>
        <!-- Alumni Detail Modal -->
        <div id="alumniModal" class="fixed inset-0 z-50 hidden">
            <div class="modal-backdrop absolute inset-0 bg-black bg-opacity-50" onclick="closeModal()"></div>
            <div class="relative flex items-center justify-center min-h-screen p-4">
                <div
                    class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto transform transition-all">
                    <div id="modalContent">
                        <!-- Modal content will be inserted here -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div id="toast"
            class="fixed bottom-4 right-4 transform translate-x-full transition-transform duration-300 z-50">
            <div class="bg-white rounded-lg shadow-lg p-4 flex items-center space-x-3">
                <div id="toastIcon"></div>
                <p id="toastMessage" class="text-slate-800"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Global variables
    let allAlumni = [];
    let displayedAlumni = [];
    let currentMajor = 'all';
    let currentStatus = 'all';
    let alumniPerPage = 6;
    let currentPage = 1;
    let favorites = JSON.parse(localStorage.getItem('favorites')) || [];

    // Initialize the app
    document.addEventListener('DOMContentLoaded', function () {
        fetchAlumni();
        setupSearchListener();
    });

    // Data alumni dari database (via Laravel)
    const rawGraduations = @json($graduations);

    // Fetch alumni data dari database
    function fetchAlumni() {
        showLoading();

        setTimeout(() => {
            allAlumni = rawGraduations.map((g, i) => {
                const status = g.status_job || 'Mencari Kerja';
                let workInfo = {};
                if (status === 'Bekerja') {
                    workInfo = {
                        company: g.status_major_now || '-',
                        position: '-',
                        location: '-'
                    };
                } else if (status === 'Studi Lanjut') {
                    workInfo = {
                        university: g.status_major_now || '-',
                        program: 'S2'
                    };
                } else if (status === 'Wirausaha') {
                    workInfo = {
                        business: g.status_major_now || '-',
                        role: 'Founder / CEO'
                    };
                }

                return {
                    id: `ALM-${String(g.id).padStart(4, '0')}`,
                    nim: g.npm || '-',
                    name: g.name || '-',
                    major: g.major || '-',
                    graduationYear: g.year || '-',
                    status: status,
                    workInfo: workInfo,
                    email: `${(g.name || 'alumni').toLowerCase().replace(/\s+/g, '.')}@alumni.ac.id`,
                    phone: '-',
                    linkedin: '-',
                    gpa: '-',
                    skills: [],
                    photo: g.photo || null,
                    isFavorite: favorites.includes(`ALM-${String(g.id).padStart(4, '0')}`)
                };
            });
            displayedAlumni = [...allAlumni];
            hideLoading();
            renderAlumni();
            updateStats();
        }, 500);
    }



    // Render alumni ID cards to grid
    function renderAlumni() {
        const grid = document.getElementById('alumniGrid');
        const start = 0;
        const end = currentPage * alumniPerPage;
        const alumniToShow = displayedAlumni.slice(start, end);

        if (alumniToShow.length === 0) {
            grid.innerHTML = '';
            document.getElementById('noResults').classList.remove('hidden');
            document.getElementById('loadMoreBtn').classList.add('hidden');
            return;
        }

        document.getElementById('noResults').classList.add('hidden');

        grid.innerHTML = alumniToShow.map(alumni => createCleanIDCard(alumni)).join('');

        // Add animation to cards
        setTimeout(() => {
            document.querySelectorAll('.id-card-wrapper').forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('fade-in');
                }, index * 50);
            });
        }, 10);

        // Update load more button
        if (end >= displayedAlumni.length) {
            document.getElementById('loadMoreBtn').classList.add('hidden');
        } else {
            document.getElementById('loadMoreBtn').classList.remove('hidden');
        }
    }

    // Create Clean ID Card HTML
    function createCleanIDCard(alumni) {
        const statusColor = getStatusColor(alumni.status);
        const statusIcon = getStatusIcon(alumni.status);

        return `
                <div class="id-card-wrapper card-hover cursor-pointer landscape-card" onclick="showAlumniDetail('${alumni.id}')">
                    <div class="id-card-inner">
                        <!-- Card Header -->
                        <div class="id-card-header p-3 text-white">
                            <div class="text-center">
                                <p class="text-xs font-bold">KARTU IDENTITAS ALUMNI</p>
                                <p class="text-xs opacity-80">UNIVERSITAS MUHAMMADIYAH JAMBI</p>
                            </div>
                        </div>
                        
                        <!-- Card Body - Clean Landscape Layout -->
                        <div class="flex h-full">
                            <!-- Left Section - Photo/Icon -->
                            <div class="photo-section w-1/3 p-4 flex flex-col items-center justify-center">
                                <div class="graduate-icon-bg w-16 h-16 rounded-full flex items-center justify-center shadow-md mb-3">
                                    <i class="fas fa-user-graduate text-white text-2xl"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-800 text-center">${alumni.name}</p>
                                <p class="text-xs text-slate-600 text-center">${alumni.id}</p>
                            </div>
                            
                            <!-- Right Section - Information -->
                            <div class="flex-1 p-4">
                                <div class="space-y-2">
                                    <!-- NIM -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-slate-500 font-medium">NIM</span>
                                        <span class="text-xs font-semibold text-slate-800">${alumni.nim}</span>
                                    </div>
                                    
                                    <!-- Jurusan -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-slate-500 font-medium">Jurusan</span>
                                        <span class="text-xs font-semibold text-slate-800">${alumni.major}</span>
                                    </div>
                                    
                                    <!-- Tahun Lulus -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-slate-500 font-medium">Tahun Lulus</span>
                                        <span class="text-xs font-semibold text-slate-800">${alumni.graduationYear}</span>
                                    </div>
                                    
                                    <!-- Status -->
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-slate-500 font-medium">Status</span>
                                        <div class="${statusColor} text-white rounded-full px-2 py-1 inline-flex items-center">
                                            <i class="${statusIcon} text-xs mr-1"></i>
                                            <span class="text-xs font-semibold">${alumni.status}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Work Status Detail -->
                                <div class="mt-3 pt-3 border-t border-gray-100">
                                    <p class="text-xs text-slate-600 font-medium mb-1">Saat Ini:</p>
                                    <p class="text-xs font-semibold text-slate-800">${getWorkStatusText(alumni)}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Footer -->
                        <div class="bg-gray-50 px-4 py-1.5 text-center border-t">
                            <p class="text-xs text-slate-500">Berlaku Seumur Hidup</p>
                        </div>
                    </div>
                </div>
            `;
    }

    // Get status color class
    function getStatusColor(status) {
        const colors = {
            'Bekerja': 'bg-gradient-to-r from-green-500 to-emerald-600',
            'Studi Lanjut': 'bg-gradient-to-r from-purple-500 to-pink-600',
            'Mencari Kerja': 'bg-gradient-to-r from-blue-500 to-cyan-600',
            'Wirausaha': 'bg-gradient-to-r from-orange-500 to-red-600'
        };
        return colors[status] || 'bg-gray-500';
    }

    // Get status icon
    function getStatusIcon(status) {
        const icons = {
            'Bekerja': 'fas fa-briefcase',
            'Studi Lanjut': 'fas fa-graduation-cap',
            'Mencari Kerja': 'fas fa-search',
            'Wirausaha': 'fas fa-rocket'
        };
        return icons[status] || 'fas fa-user';
    }

    // Get work status text
    function getWorkStatusText(alumni) {
        if (alumni.status === 'Bekerja') {
            return `${alumni.workInfo.position} at ${alumni.workInfo.company}`;
        } else if (alumni.status === 'Studi Lanjut') {
            return `${alumni.workInfo.program} - ${alumni.workInfo.university}`;
        } else if (alumni.status === 'Wirausaha') {
            return alumni.workInfo.business;
        } else {
            return 'Sedang Mencari Kesempatan';
        }
    }

    // Show alumni detail modal
    function showAlumniDetail(alumniId) {
        const alumni = allAlumni.find(a => a.id === alumniId);
        if (!alumni) return;

        const modal = document.getElementById('alumniModal');
        const modalContent = document.getElementById('modalContent');

        modalContent.innerHTML = `
                <div class="relative">
                    <button onclick="closeModal()" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 z-10 bg-white rounded-full p-2 shadow-md">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                    <div class="id-card-header p-8 text-white">
                        <div class="flex items-center gap-6">
                            <div class="graduate-icon-bg w-24 h-24 rounded-full flex items-center justify-center shadow-xl">
                                <i class="fas fa-user-graduate text-white text-4xl"></i>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold mb-2">${alumni.name}</h2>
                                <p class="text-lg opacity-90">${alumni.id}</p>
                                <p class="text-sm opacity-80 mt-1">Alumni Universitas Digital Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-slate-500 text-sm">NIM</p>
                            <p class="font-semibold text-slate-800">${alumni.nim}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-slate-500 text-sm">Jurusan</p>
                            <p class="font-semibold text-slate-800">${alumni.major}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-slate-500 text-sm">Tahun Lulus</p>
                            <p class="font-semibold text-slate-800">${alumni.graduationYear}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-slate-500 text-sm">IPK</p>
                            <p class="font-semibold text-slate-800">${alumni.gpa}</p>
                        </div>
                    </div>
                    
                    <div class="${getStatusColor(alumni.status)} text-white rounded-lg p-4 mb-6">
                        <div class="flex items-center mb-2">
                            <i class="${getStatusIcon(alumni.status)} text-2xl mr-3"></i>
                            <div>
                                <p class="font-bold text-lg">${alumni.status}</p>
                                <p class="text-sm opacity-90">${getWorkStatusText(alumni)}</p>
                            </div>
                        </div>
                        ${alumni.status === 'Bekerja' ? `
                            <div class="mt-2 text-sm">
                                <p><i class="fas fa-building mr-2"></i>${alumni.workInfo.company}</p>
                                <p><i class="fas fa-map-marker-alt mr-2"></i>${alumni.workInfo.location}</p>
                            </div>
                        ` : ''}
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-slate-700 font-semibold mb-2">Keahlian:</p>
                        <div class="flex flex-wrap gap-2">
                            ${alumni.skills.map(skill => `
                                <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm">
                                    ${skill}
                                </span>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <div class="space-y-3">
                            <a href="mailto:${alumni.email}" class="flex items-center text-slate-600 hover:text-blue-600 transition-colors">
                                <i class="fas fa-envelope w-5 mr-3"></i>
                                <span>${alumni.email}</span>
                            </a>
                            <a href="tel:${alumni.phone}" class="flex items-center text-slate-600 hover:text-blue-600 transition-colors">
                                <i class="fas fa-phone w-5 mr-3"></i>
                                <span>${alumni.phone}</span>
                            </a>
                            <a href="https://${alumni.linkedin}" target="_blank" class="flex items-center text-slate-600 hover:text-blue-600 transition-colors">
                                <i class="fab fa-linkedin w-5 mr-3"></i>
                                <span>${alumni.linkedin}</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex gap-3 mt-6">
                        <button 
                            onclick="contactAlumni(event, '${alumni.id}')" 
                            class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all"
                        >
                            <i class="fas fa-envelope mr-2"></i>
                            Kirim Pesan
                        </button>
                        <button 
                            onclick="connectLinkedIn(event, '${alumni.id}')" 
                            class="px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all"
                        >
                            <i class="fab fa-linkedin"></i>
                        </button>
                        <button 
                            onclick="toggleFavorite('${alumni.id}')" 
                            class="px-4 py-3 border-2 border-gray-300 text-slate-600 rounded-lg hover:bg-gray-50 transition-all"
                        >
                            <i class="fas fa-heart ${favorites.includes(alumni.id) ? 'text-red-500' : ''}"></i>
                        </button>
                    </div>
                </div>
            `;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.add('fade-in');
        }, 10);
    }

    // Close modal
    function closeModal() {
        const modal = document.getElementById('alumniModal');
        modal.classList.add('hidden');
    }

    // Toggle favorite
    function toggleFavorite(alumniId) {
        const index = favorites.indexOf(alumniId);

        if (index > -1) {
            favorites.splice(index, 1);
            showToast('Dihapus dari favorit', 'info');
        } else {
            favorites.push(alumniId);
            showToast('Ditambahkan ke favorit', 'success');
        }

        localStorage.setItem('favorites', JSON.stringify(favorites));

        // Update alumni data
        const alumni = allAlumni.find(a => a.id === alumniId);
        if (alumni) {
            alumni.isFavorite = !alumni.isFavorite;
        }

        showAlumniDetail(alumniId);
        updateStats();
    }

    // Contact alumni
    function contactAlumni(event, alumniId) {
        event.stopPropagation();
        const alumni = allAlumni.find(a => a.id === alumniId);
        showToast(`Menghubungi ${alumni.name}...`, 'success');
    }

    // Connect LinkedIn
    function connectLinkedIn(event, alumniId) {
        event.stopPropagation();
        const alumni = allAlumni.find(a => a.id === alumniId);
        showToast(`Menghubungkan dengan ${alumni.name} di LinkedIn`, 'success');
    }

    // Filter by major
    function filterByMajor(major) {
        currentMajor = major;
        currentPage = 1;
        applyFilters();

        // Update button styles
        document.querySelectorAll('.major-btn').forEach(btn => {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-slate-700');
        });
        event.target.classList.remove('bg-gray-200', 'text-slate-700');
        event.target.classList.add('bg-blue-600', 'text-white');
    }

    // Filter by status
    function filterByStatus() {
        currentStatus = document.getElementById('statusFilter').value;
        currentPage = 1;
        applyFilters();
    }

    // Apply all filters
    function applyFilters() {
        displayedAlumni = allAlumni.filter(alumni => {
            const majorMatch = currentMajor === 'all' || alumni.major === currentMajor;
            const statusMatch = currentStatus === 'all' || alumni.status === currentStatus;
            return majorMatch && statusMatch;
        });
        renderAlumni();
    }

    // Sort alumni
    function sortAlumni() {
        const sortValue = document.getElementById('sortSelect').value;

        switch (sortValue) {
            case 'name-asc':
                displayedAlumni.sort((a, b) => a.name.localeCompare(b.name));
                break;
            case 'year-desc':
                displayedAlumni.sort((a, b) => b.graduationYear - a.graduationYear);
                break;
            case 'year-asc':
                displayedAlumni.sort((a, b) => a.graduationYear - b.graduationYear);
                break;
            default:
                applyFilters();
                return;
        }

        currentPage = 1;
        renderAlumni();
    }

    // Setup search listener
    function setupSearchListener() {
        const searchInput = document.getElementById('searchInput');
        let searchTimeout;

        searchInput.addEventListener('input', function (e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                const searchTerm = e.target.value.toLowerCase();

                if (searchTerm === '') {
                    applyFilters();
                } else {
                    displayedAlumni = allAlumni.filter(alumni =>
                        alumni.name.toLowerCase().includes(searchTerm) ||
                        alumni.nim.toLowerCase().includes(searchTerm) ||
                        alumni.major.toLowerCase().includes(searchTerm)
                    );
                }

                currentPage = 1;
                renderAlumni();
            }, 300);
        });
    }

    // Load more alumni
    function loadMoreAlumni() {
        currentPage++;
        renderAlumni();
    }

    // Update statistics
    function updateStats() {
        document.getElementById('totalAlumni').textContent = allAlumni.length;

        const workingCount = allAlumni.filter(a => a.status === 'Bekerja').length;
        document.getElementById('workingCount').textContent = workingCount;

        const studyingCount = allAlumni.filter(a => a.status === 'Studi Lanjut').length;
        document.getElementById('studyingCount').textContent = studyingCount;

        const entrepreneurCount = allAlumni.filter(a => a.status === 'Wirausaha').length;
        document.getElementById('entrepreneurCount').textContent = entrepreneurCount;
    }

    // Show loading indicator
    function showLoading() {
        document.getElementById('loadingIndicator').classList.remove('hidden');
        document.getElementById('alumniGrid').classList.add('hidden');
    }

    // Hide loading indicator
    function hideLoading() {
        document.getElementById('loadingIndicator').classList.add('hidden');
        document.getElementById('alumniGrid').classList.remove('hidden');
    }

    // Show toast notification
    function showToast(message, type = 'info') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        const toastIcon = document.getElementById('toastIcon');

        toastMessage.textContent = message;

        // Set icon based on type
        const icons = {
            success: '<i class="fas fa-check-circle text-green-500 text-xl"></i>',
            error: '<i class="fas fa-times-circle text-red-500 text-xl"></i>',
            info: '<i class="fas fa-info-circle text-blue-500 text-xl"></i>'
        };
        toastIcon.innerHTML = icons[type] || icons.info;

        // Show toast
        toast.classList.remove('translate-x-full');

        // Hide after 3 seconds
        setTimeout(() => {
            toast.classList.add('translate-x-full');
        }, 3000);
    }

</script>
@endsection
