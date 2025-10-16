<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Pembayaran - Lion Air</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload-area:hover {
            border-color: #e11d48;
            background-color: #fef2f2;
        }
        
        .file-upload-area.dragover {
            border-color: #e11d48;
            background-color: #fef2f2;
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
                            <a href="{{ route('pemesanan.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-red-600 md:ml-2">Pesanan Saya</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Upload Pembayaran</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Upload Bukti Pembayaran</h1>
            <p class="text-gray-600 mt-2">Lengkapi proses pembayaran untuk pesanan Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Upload -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
                    <div class="hero-gradient text-white p-6">
                        <h2 class="text-xl font-bold">Pembayaran Pesanan #{{ $pemesanan->id }}</h2>
                        <p class="opacity-90 mt-1">Upload bukti pembayaran untuk menyelesaikan pemesanan</p>
                    </div>
                    
                    <div class="p-6">
                        <!-- Order Summary -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-semibold text-gray-800 mb-3">Ringkasan Pesanan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Total Pembayaran</p>
                                    <p class="font-bold text-red-600 text-xl">Rp {{ number_format($pemesanan->total_harga,0,',','.') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status</p>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Menunggu Pembayaran
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form -->
                        <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                            @csrf
                            <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
                            
                            <!-- Payment Method -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-credit-card mr-2"></i>
                                    Metode Pembayaran
                                </label>
                                <select name="metode_pembayaran" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                    <option value="Transfer">Transfer Bank</option>
                                    <option value="E-Wallet">E-Wallet</option>
                                    <option value="Kartu Kredit">Kartu Kredit</option>
                                    <option value="Virtual Account">Virtual Account</option>
                                </select>
                            </div>
                            
                            <!-- File Upload -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-file-upload mr-2"></i>
                                    Upload Bukti Pembayaran
                                </label>
                                
                                <div class="file-upload-area" id="fileUploadArea">
                                    <input type="file" name="bukti_pembayaran" id="buktiPembayaran" accept="image/*" class="hidden" required>
                                    
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                        <p class="text-lg font-medium text-gray-700 mb-1">Upload bukti pembayaran</p>
                                        <p class="text-sm text-gray-500 mb-3">Format: JPG, PNG (Maks. 5MB)</p>
                                        <button type="button" class="btn btn-outline" onclick="document.getElementById('buktiPembayaran').click()">
                                            <i class="fas fa-folder-open"></i>
                                            Pilih File
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- File Preview -->
                                <div id="filePreview" class="mt-4 hidden">
                                    <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-file-image text-green-600 text-xl mr-3"></i>
                                            <div>
                                                <p class="font-medium text-gray-800" id="fileName">file-name.jpg</p>
                                                <p class="text-sm text-gray-600" id="fileSize">0 KB</p>
                                            </div>
                                        </div>
                                        <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFile()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Terms and Conditions -->
                            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                                    <div>
                                        <h4 class="font-medium text-blue-800 mb-1">Informasi Penting</h4>
                                        <ul class="text-sm text-blue-700 list-disc list-inside space-y-1">
                                            <li>Pastikan bukti pembayaran jelas dan terbaca</li>
                                            <li>Proses verifikasi membutuhkan waktu 1-2 jam kerja</li>
                                            <li>Pesanan akan dibatalkan otomatis jika pembayaran tidak diterima dalam 24 jam</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex gap-3">
                                <a href="{{ url()->previous() }}" class="btn btn-outline flex-1">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                                <button type="submit" class="btn btn-primary flex-1" id="submitBtn">
                                    <i class="fas fa-paper-plane"></i>
                                    Kirim Bukti Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24 card-hover">
                    <h3 class="font-semibold text-gray-800 mb-4">Informasi Pembayaran</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm">Pembayaran Aman</h4>
                                <p class="text-xs text-gray-600 mt-1">Transaksi Anda dilindungi dengan sistem keamanan terbaik.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm">Verifikasi Cepat</h4>
                                <p class="text-xs text-gray-600 mt-1">Proses verifikasi biasanya selesai dalam 1-2 jam.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-headset text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800 text-sm">Bantuan 24/7</h4>
                                <p class="text-xs text-gray-600 mt-1">Tim customer service kami siap membantu kapan saja.</p>
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
                
                <!-- Payment Methods Info -->
                <div class="bg-white rounded-xl shadow-md p-6 mt-6 card-hover">
                    <h3 class="font-semibold text-gray-800 mb-4">Metode Pembayaran yang Didukung</h3>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 border border-gray-200 rounded-lg text-center">
                            <i class="fas fa-university text-blue-500 text-xl mb-2"></i>
                            <p class="text-xs font-medium text-gray-700">Transfer Bank</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg text-center">
                            <i class="fas fa-mobile-alt text-green-500 text-xl mb-2"></i>
                            <p class="text-xs font-medium text-gray-700">E-Wallet</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg text-center">
                            <i class="fas fa-credit-card text-purple-500 text-xl mb-2"></i>
                            <p class="text-xs font-medium text-gray-700">Kartu Kredit</p>
                        </div>
                        <div class="p-3 border border-gray-200 rounded-lg text-center">
                            <i class="fas fa-qrcode text-orange-500 text-xl mb-2"></i>
                            <p class="text-xs font-medium text-gray-700">Virtual Account</p>
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
    
    // File upload functionality
    (function () {
        const fileInput = document.getElementById('buktiPembayaran');
        const fileUploadArea = document.getElementById('fileUploadArea');
        const filePreview = document.getElementById('filePreview');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const submitBtn = document.getElementById('submitBtn');
        
        // File input change event
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file type
                if (!file.type.match('image.*')) {
                    alert('Hanya file gambar yang diizinkan (JPG, PNG)');
                    return;
                }
                
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file maksimal 5MB');
                    return;
                }
                
                // Display file info
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                filePreview.classList.remove('hidden');
                fileUploadArea.classList.add('hidden');
                
                // Enable submit button
                submitBtn.disabled = false;
            }
        });
        
        // Drag and drop functionality
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });
        
        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
        });
        
        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Remove file function
        window.removeFile = function() {
            fileInput.value = '';
            filePreview.classList.add('hidden');
            fileUploadArea.classList.remove('hidden');
            submitBtn.disabled = true;
        };
        
        // Form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const file = fileInput.files[0];
            if (!file) {
                e.preventDefault();
                alert('Silakan pilih file bukti pembayaran');
                return;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
        });
    })();
</script>

</body>
</html>