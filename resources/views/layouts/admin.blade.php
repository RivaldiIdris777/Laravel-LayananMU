<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LayananMU')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo_umjambi.png') }}">
    <!-- Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">   
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .accordion-content.active {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .submenu.active {
            max-height: 500px;
        }
        @media (max-width: 768px) {
            .sidebar-mobile {
                transform: translateX(-100%);
            }
            .sidebar-mobile.active {
                transform: translateX(0);
            }
        }
    </style>  

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')  
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed top-0 left-0 right-0 z-40">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <button id="mobileMenuBtn" class="md:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex-shrink-0 flex items-center ml-4 md:ml-0">
                        <i class="fas fa-chart-line text-blue-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-slate-800">Dashboard LayananMu</span>
                    </div>
                </div>
                
                <!-- User Profile Dropdown -->
                <div class="flex items-center">
                    <div class="relative">
                        @if(auth()->user()->isAdmin())
                        <button id="userMenuBtn" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <img class="h-8 w-8 rounded-full" src="https://picsum.photos/seed/user123/100/100.jpg" alt="User">
                            <span class="ml-2 text-slate-700 font-medium hidden sm:block">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down ml-2 text-gray-500"></i>
                        </button>
                        @endif
                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                    <i class="fas fa-user mr-2"></i> Profil Saya
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                    <i class="fas fa-cog mr-2"></i> Pengaturan
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                    <i class="fas fa-bell mr-2"></i> Notifikasi
                                </a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar-transition sidebar-mobile md:translate-x-0 fixed left-0 top-16 h-full w-64 bg-gray-900 text-white z-30 overflow-y-auto">
        <div class="p-4">
            <!-- Single Menu Item -->
            <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition-colors mb-2">
                <i class="fas fa-home w-5"></i>
                <span class="ml-3">Dashboard</span>
            </a>            
            
             <div class="mb-2">
                <button onclick="toggleSubmenu('submenu1')" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-800 transition-colors">
                    <div class="flex items-center">
                        <i class="fas fa-user w-5"></i>
                        <span class="ml-3">Data User</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform" id="submenu1-icon"></i>
                </button>
                <div id="submenu1" class="submenu ml-8">
                    <a href="{{ route('admin.profile.show') }}" class="block py-2 px-3 text-sm hover:bg-gray-800 rounded">Profil</a>
                    <a href="{{ route('admin.users') }}" class="block py-2 px-3 text-sm hover:bg-gray-800 rounded">List User</a>                    
                </div>
            </div>

            <!-- Menu with Submenu (1 level) -->
            <div class="mb-2">
                <button onclick="toggleSubmenu('submenu2')" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-800 transition-colors">
                    <div class="flex items-center">
                        <i class="fas fa-cube w-5"></i>
                        <span class="ml-3">Produk Mahasiswa</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform" id="submenu2-icon"></i>
                </button>
                <div id="submenu2" class="submenu ml-8">
                    <a href="#" class="block py-2 px-3 text-sm hover:bg-gray-800 rounded">Pineroma</a>
                    <a href="#" class="block py-2 px-3 text-sm hover:bg-gray-800 rounded">Open Trip</a>                    
                </div>
            </div>

            <!-- Menu with Submenu (2 level) -->
            <div class="mb-2">
                <button onclick="toggleSubmenu('submenu3')" class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-800 transition-colors">
                    <div class="flex items-center">
                        <i class="fas fa-cog w-5"></i>
                        <span class="ml-3">Konsultasi</span>
                    </div>
                    <i class="fas fa-chevron-down text-xs transition-transform" id="submenu3-icon"></i>
                </button>
                <div id="submenu3" class="submenu ml-8">
                    <a href="#" class="block py-2 px-3 text-sm hover:bg-gray-800 rounded">Layanan Konsultasi Hukum</a>
                    <a href="{{ route('admin.list-chat-complain') }}" class="block py-2 px-3 text-sm hover:bg-gray-800 rounded">Layanan Keluhan Mahasiswa</a>
                </div>
            </div>            

            <!-- More Single Menu Items -->
            <a href="{{ route('admin.graduation') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition-colors mb-2">
                <i class="fas fa-graduation-cap"></i>
                <span class="ml-3">Lulusan</span>                
            </a>            
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:ml-64 mt-16 p-4 sm:p-6 lg:p-8">
        @yield('contentadmin')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 md:ml-64 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">© 2024 Dashboard Modern. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Modal Popup</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Ini adalah contoh modal popup yang dapat digunakan untuk menampilkan informasi tambahan atau form interaktif.
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="closeModal()" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-lg w-full shadow-sm hover:bg-blue-700 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // User Dropdown
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', function() {
                    userDropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuBtn.contains(event.target) && !userDropdown.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }

            // Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebar = document.getElementById('sidebar');
            
            if (mobileMenuBtn && sidebar) {
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

        });

        // Submenu Toggle
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');
            if (!submenu) return;
            
            submenu.classList.toggle('active');
            
            if (icon) {
                icon.style.transform = submenu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        }

        // Accordion Toggle
        function toggleAccordion(id) {
            const accordion = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');
            if (!accordion) return;
            
            // Close all other accordions
            document.querySelectorAll('.accordion-content').forEach(item => {
                if (item.id !== id) {
                    item.classList.remove('active');
                    const otherIcon = document.getElementById(item.id + '-icon');
                    if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                }
            });
            
            accordion.classList.toggle('active');
            
            if (icon) {
                icon.style.transform = accordion.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        }

        // Modal Functions
        function openModal() {
            const modal = document.getElementById('modal');
            if (modal) modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('modal');
            if (modal) modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('modal');
            if (modal && event.target == modal) {
                closeModal();
            }
        });
    </script>

    @yield('scripts')
</body>
</html>