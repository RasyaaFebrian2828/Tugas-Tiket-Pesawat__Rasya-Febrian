<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Lion Air</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    /* Custom Styles */
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
    
    .search-box {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
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
    
    .hidden-on-load { display: none; }
    
    @media (max-width: 768px) {
      .mobile-bottom-nav {
        display: flex;
      }
    }
    
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

<!-- Main -->
<main class="flex-1 flex items-center justify-center py-16 px-4">
  <div class="bg-white rounded-xl shadow-md card-hover w-full max-w-md overflow-hidden search-box">
    <div class="hero-gradient p-8 text-center text-white">
      <h1 class="text-2xl md:text-3xl font-bold mb-2">Login ke Akun Anda</h1>
      <p class="text-white/80 text-sm">Masuk untuk melanjutkan pemesanan Anda</p>
    </div>

    <div class="p-8">
      @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 text-sm flex items-center gap-2">
          <i class="fas fa-exclamation-circle"></i>
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST" class="space-y-6">
        @csrf
        <div>
          <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
          <div class="relative">
            <input type="email" id="email" name="email" required 
              class="w-full border-gray-300 border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" 
              placeholder="Masukkan email Anda">
            <i class="fas fa-envelope absolute right-3 top-3 text-gray-400"></i>
          </div>
        </div>

        <div>
          <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
          <div class="relative">
            <input type="password" id="password" name="password" required 
              class="w-full border-gray-300 border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors" 
              placeholder="Masukkan password Anda">
            <i class="fas fa-lock absolute right-3 top-3 text-gray-400"></i>
          </div>
        </div>

        <button type="submit" 
          class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
          <i class="fas fa-sign-in-alt"></i>
          Login ke Akun
        </button>
      </form>

      <div class="mt-8 pt-6 border-t border-gray-200">
        <p class="text-center text-sm text-gray-600">
          Belum punya akun? 
          <a href="{{ route('register') }}" class="text-red-600 hover:text-red-700 font-medium transition-colors">Daftar Sekarang</a>
        </p>
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
  <a href="{{ route('pemesanan.index') }}" class="mobile-nav-item">
    <i class="fas fa-ticket-alt mobile-nav-icon"></i>
    <span>Pesanan</span>
  </a>
  <a href="{{ route('user.dashboard') }}" class="mobile-nav-item active">
    <i class="fas fa-user mobile-nav-icon"></i>
    <span>Profil</span>
  </a>
</div>

<script>
  // toggle sederhana untuk profile dropdown
  (function () {
      const btn = document.getElementById('profileBtn');
      const menu = document.getElementById('profileMenu');
      if (!btn || !menu) return;
      
      document.addEventListener('click', function (e) {
          const target = e.target;
          if (btn.contains(target)) {
              // toggle
              menu.classList.toggle('hidden-on-load');
          } else {
              // klik di luar -> sembunyikan
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
          
          // Close mobile menu when clicking outside
          document.addEventListener('click', function(e) {
              if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                  mobileMenu.classList.add('closed');
                  mobileMenu.classList.remove('open');
              }
          });
      }
  })();
</script>

</body>
</html>