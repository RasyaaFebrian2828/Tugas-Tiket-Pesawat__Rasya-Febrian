<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Pesan Tiket - Lion Air</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: #e11d48;
            color: white;
            border: 1px solid #e11d48;
        }
        
        .btn-primary:hover {
            background-color: #be123c;
            border-color: #be123c;
        }
        
        .btn-outline {
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }
        
        .btn-outline:hover {
            background-color: #f9fafb;
            border-color: #9ca3af;
        }
        
        .notification-badge {
            position: absolute;
            top: -0.5rem;
            right: -0.5rem;
            background-color: #e11d48;
            color: white;
            border-radius: 9999px;
            width: 1.25rem;
            height: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .mobile-menu {
            transition: all 0.3s ease;
        }
        
        .mobile-menu.open {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        
        .mobile-menu.closed {
            display: none;
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-around;
            padding: 0.5rem 0;
            z-index: 50;
        }
        
        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0.5rem;
            color: #6b7280;
            font-size: 0.75rem;
        }
        
        .mobile-nav-item.active {
            color: #e11d48;
        }
        
        .mobile-nav-icon {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }
        
        .hidden-on-load { display: none; }
        
        @media (min-width: 769px) {
            .mobile-bottom-nav {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- Header -->
<header class="bg-red-600 p-4 text-white sticky top-0 z-40 shadow-md">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="bg-white p-1 rounded-lg">
                <img src="{{ asset('images/lionair-logo.png') }}" alt="Lion Air" class="h-8">
            </div>
            <span class="font-bold text-lg">Lion Air</span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-6">
            <a href="#" class="font-medium hover:text-red-100 transition-colors">Beranda</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors">Penerbangan</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors">Tentang Kami</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors">Bantuan</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors">Kontak</a>
        </nav>

        <div class="flex items-center gap-3">
            <!-- Notification Bell -->
            <div class="relative">
                <button class="p-2 rounded-full hover:bg-red-700 transition-colors">
                    <i class="fas fa-bell"></i>
                </button>
                <span class="notification-badge">3</span>
            </div>
            
            <!-- Language Selector -->
            <div class="hidden md:block relative">
                <button class="flex items-center gap-1 px-3 py-1 rounded hover:bg-red-700 transition-colors">
                    <i class="fas fa-globe"></i>
                    <span>ID</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
            </div>
            
            @guest
                <a href="{{ route('login') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">Login</a>
                <a href="{{ route('register') }}" class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">Register</a>
            @else
                <!-- profile dropdown -->
                <div class="relative" id="profileRoot">
                    <button id="profileBtn" class="flex items-center gap-2 bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                        <img src="{{ asset('images/avatar.png') }}" alt="avatar" class="w-8 h-8 rounded-full object-cover">
                        <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="profileMenu" class="absolute right-0 mt-2 w-56 bg-white text-gray-800 rounded-lg shadow-xl hidden-on-load z-50 overflow-hidden">
                        <div class="p-4 border-b">
                            <p class="font-semibold">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('pemesanan.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-ticket-alt w-5"></i>
                            <span>Pesanan Saya</span>
                        </a>
                        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-user-circle w-5"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="#" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                            <i class="fas fa-gift w-5"></i>
                            <span>Rewards Saya</span>
                        </a>
                        <div class="border-t"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-3 text-sm hover:bg-gray-100 text-red-600 transition-colors">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="md:hidden p-2 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu closed md:hidden bg-red-600 mt-2 py-3 px-4 rounded-lg shadow-lg">
        <nav class="flex flex-col gap-3">
            <a href="#" class="font-medium hover:text-red-100 transition-colors py-1">Beranda</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors py-1">Penerbangan</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors py-1">Tentang Kami</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors py-1">Bantuan</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors py-1">Kontak</a>
            <div class="border-t border-red-500 pt-3 mt-1">
                <a href="#" class="flex items-center gap-2 font-medium hover:text-red-100 transition-colors py-1">
                    <i class="fas fa-globe"></i>
                    <span>Bahasa Indonesia</span>
                </a>
            </div>
        </nav>
    </div>
</header>

<!-- Main Content -->
<main class="flex-1 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                            <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ml-2">Penerbangan</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Pesan Tiket</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Pesan Tiket</h1>
            <p class="text-gray-600 mt-2">Lengkapi informasi pemesanan tiket Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Pemesanan -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="hero-gradient text-white p-6">
                        <h2 class="text-xl font-bold">{{ $kelas->penerbangan->asal }} → {{ $kelas->penerbangan->tujuan }}</h2>
                        <p class="opacity-90 mt-1">Detail penerbangan dan kelas yang dipilih</p>
                    </div>
                    
                    <div class="p-6">
                        <!-- Flight Info -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <h3 class="font-semibold text-gray-800">Informasi Penerbangan</h3>
                                    <p class="text-sm text-gray-600">Kode: {{ $kelas->penerbangan->kode ?? 'LA-' . $kelas->penerbangan->id }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">{{ date('d M Y', strtotime($kelas->penerbangan->waktu_berangkat ?? now())) }}</p>
                                    <p class="font-medium">{{ date('H:i', strtotime($kelas->penerbangan->waktu_berangkat ?? now())) }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="text-center">
                                    <p class="font-bold text-lg">{{ $kelas->penerbangan->asal }}</p>
                                    <p class="text-sm text-gray-600">Bandara {{ $kelas->penerbangan->asal }}</p>
                                </div>
                                
                                <div class="flex flex-col items-center mx-4">
                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-plane text-red-600 text-sm"></i>
                                    </div>
                                    <div class="w-24 h-0.5 bg-gray-300 my-1"></div>
                                    <p class="text-xs text-gray-500">Langsung</p>
                                </div>
                                
                                <div class="text-center">
                                    <p class="font-bold text-lg">{{ $kelas->penerbangan->tujuan }}</p>
                                    <p class="text-sm text-gray-600">Bandara {{ $kelas->penerbangan->tujuan }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Class Info -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold text-gray-800 mb-3">Kelas yang Dipilih</h3>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $kelas->nama_kelas }}</p>
                                    <p class="text-sm text-gray-600 mt-1">Sisa kursi: {{ $kelas->sisa_kursi }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Harga per tiket</p>
                                    <p class="font-bold text-red-600 text-lg">Rp {{ number_format($kelas->harga,0,',','.') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form -->
                        <form action="{{ route('pemesanan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">
                            
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Tiket</label>
                                <div class="flex items-center">
                                    <button type="button" id="decreaseBtn" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-l-lg hover:bg-gray-300 transition-colors">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="jumlah_tiket" id="jumlahTiket" min="1" max="{{ $kelas->sisa_kursi }}" value="1" 
                                           class="w-20 text-center border-y border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <button type="button" id="increaseBtn" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-r-lg hover:bg-gray-300 transition-colors">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Maksimal: {{ $kelas->sisa_kursi }} tiket</p>
                            </div>
                            
                            <!-- Total Price -->
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-800">Total Pembayaran</span>
                                    <span id="totalHarga" class="font-bold text-red-600 text-xl">Rp {{ number_format($kelas->harga,0,',','.') }}</span>
                                </div>
                            </div>
                            
                            <div class="flex gap-3">
                                <a href="{{ url()->previous() }}" class="btn btn-outline flex-1">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary flex-1">
                                    <i class="fas fa-shopping-cart"></i>
                                    Pesan Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24 card-hover">
                    <h3 class="font-semibold text-gray-800 mb-4">Informasi Penting</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-info-circle text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm">Konfirmasi Instan</h4>
                                <p class="text-xs text-gray-600 mt-1">Pemesanan akan dikonfirmasi secara instan setelah pembayaran berhasil.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm">Pembayaran Aman</h4>
                                <p class="text-xs text-gray-600 mt-1">Transaksi Anda dilindungi dengan sistem keamanan terbaik.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-headset text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm">Bantuan 24/7</h4>
                                <p class="text-xs text-gray-600 mt-1">Tim customer service kami siap membantu 24 jam sehari.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h4 class="font-medium text-gray-800 mb-3">Butuh Bantuan?</h4>
                        <div class="space-y-2">
                            <a href="#" class="flex items-center gap-2 text-sm text-red-600 hover:text-red-700 transition-colors">
                                <i class="fas fa-phone w-4"></i>
                                <span>+62 21 6379 8000</span>
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-red-600 hover:text-red-700 transition-colors">
                                <i class="fas fa-envelope w-4"></i>
                                <span>cs@lionair.co.id</span>
                            </a>
                            <a href="#" class="flex items-center gap-2 text-sm text-red-600 hover:text-red-700 transition-colors">
                                <i class="fas fa-comments w-4"></i>
                                <span>Live Chat</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-white p-1 rounded-lg">
                        <img src="{{ asset('images/lionair-logo.png') }}" alt="Lion Air" class="h-8">
                    </div>
                    <span class="font-bold text-lg">Lion Air</span>
                </div>
                <p class="text-gray-400 mb-4">Maskapai penerbangan terkemuka di Indonesia yang melayani berbagai destinasi domestik dan internasional.</p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Karir</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Berita</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Penerbangan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Status Penerbangan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Hubungi Kami</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Kontak</h3>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-phone"></i>
                        <span>+62 21 6379 8000</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-envelope"></i>
                        <span>info@lionair.co.id</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jakarta, Indonesia</span>
                    </li>
                </ul>
                
                <div class="mt-6">
                    <h4 class="font-medium mb-2">Download Aplikasi</h4>
                    <div class="flex gap-2">
                        <a href="#" class="bg-gray-700 hover:bg-gray-600 transition-colors p-2 rounded-lg">
                            <i class="fab fa-google-play"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-gray-600 transition-colors p-2 rounded-lg">
                            <i class="fab fa-app-store"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2023 Lion Air. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav md:hidden">
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-home mobile-nav-icon"></i>
        <span>Beranda</span>
    </a>
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-search mobile-nav-icon"></i>
        <span>Cari</span>
    </a>
    <a href="#" class="mobile-nav-item active">
        <i class="fas fa-ticket-alt mobile-nav-icon"></i>
        <span>Pesanan</span>
    </a>
    <a href="#" class="mobile-nav-item">
        <i class="fas fa-user mobile-nav-icon"></i>
        <span>Profil</span>
    </a>
</div>

<script>
    // Profile dropdown toggle
    (function () {
        const btn = document.getElementById('profileBtn');
        const menu = document.getElementById('profileMenu');
        if (!btn || !menu) return;
        
        document.addEventListener('click', function (e) {
            const target = e.target;
            if (btn.contains(target)) {
                menu.classList.toggle('hidden-on-load');
            } else {
                if (!menu.classList.contains('hidden-on-load')) menu.classList.add('hidden-on-load');
            }
        });
    })();
    
    // Mobile menu toggle
    (function () {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('closed');
                mobileMenu.classList.toggle('open');
            });
            
            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.add('closed');
                    mobileMenu.classList.remove('open');
                }
            });
        }
    })();
    
    // Ticket quantity and price calculation
    (function () {
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        const jumlahTiket = document.getElementById('jumlahTiket');
        const totalHarga = document.getElementById('totalHarga');
        const hargaPerTiket = {{ $kelas->harga }};
        const maxTickets = {{ $kelas->sisa_kursi }};
        
        function updateTotalPrice() {
            const jumlah = parseInt(jumlahTiket.value);
            const total = jumlah * hargaPerTiket;
            totalHarga.textContent = 'Rp ' + total.toLocaleString('id-ID');
            
            // Disable/enable buttons based on limits
            decreaseBtn.disabled = jumlah <= 1;
            increaseBtn.disabled = jumlah >= maxTickets;
        }
        
        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(jumlahTiket.value);
            if (currentValue > 1) {
                jumlahTiket.value = currentValue - 1;
                updateTotalPrice();
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(jumlahTiket.value);
            if (currentValue < maxTickets) {
                jumlahTiket.value = currentValue + 1;
                updateTotalPrice();
            }
        });
        
        jumlahTiket.addEventListener('change', function() {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > maxTickets) {
                this.value = maxTickets;
            }
            updateTotalPrice();
        });
        
        // Initialize
        updateTotalPrice();
    })();
</script>

</body>
</html>