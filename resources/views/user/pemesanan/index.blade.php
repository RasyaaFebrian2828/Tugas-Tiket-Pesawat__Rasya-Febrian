<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Saya - Singa Tanah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafb;
    }
    .hero-gradient {
      background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
    }
    .card-hover {
      transition: all 0.3s ease;
    }
    .card-hover:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 25px -10px rgba(0,0,0,0.1);
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
<body class="min-h-screen flex flex-col">

<!-- Header -->
<header class="bg-red-600 p-4 text-white shadow-md sticky top-0 z-40">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="bg-white p-1 rounded-lg">
        <div class="h-8 w-8 bg-red-600 rounded flex items-center justify-center text-white font-bold">ST</div>
      </div>
      <span class="font-bold text-lg">Singa Tanah</span>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex items-center gap-6">
      <a href="/" class="font-medium hover:text-red-100 transition-colors">Beranda</a>
      <a href="/penerbangan" class="font-medium hover:text-red-100 transition-colors">Penerbangan</a>
      <a href="/pemesanan" class="font-medium hover:text-red-100 transition-colors active">Pemesanan Saya</a>
      <a href="/tentang-kami" class="font-medium hover:text-red-100 transition-colors">Tentang Kami</a>
      <a href="/bantuan" class="font-medium hover:text-red-100 transition-colors">Bantuan</a>
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
            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs font-bold">
              {{ substr(auth()->user()->name, 0, 1) }}
            </div>
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
            <a href="/rewards" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
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
      <a href="/" class="font-medium hover:text-red-100 transition-colors py-1">Beranda</a>
      <a href="/penerbangan" class="font-medium hover:text-red-100 transition-colors py-1">Penerbangan</a>
      <a href="/pemesanan" class="font-medium hover:text-red-100 transition-colors py-1">Pemesanan Saya</a>
      <a href="/tentang-kami" class="font-medium hover:text-red-100 transition-colors py-1">Tentang Kami</a>
      <a href="/bantuan" class="font-medium hover:text-red-100 transition-colors py-1">Bantuan</a>
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
<main class="flex-1 py-10">
  <div class="max-w-6xl mx-auto px-4">
    <!-- Breadcrumb -->
    <div class="mb-6">
      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center">
            <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-red-600">
              <i class="fas fa-home mr-2"></i>
              Beranda
            </a>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
              <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Pemesanan Saya</span>
            </div>
          </li>
        </ol>
      </nav>
    </div>

    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pemesanan Saya</h1>
        <p class="text-gray-600">Lihat status & detail pesanan penerbangan Anda</p>
      </div>
      <a href="/penerbangan" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center gap-2">
        <i class="fas fa-plus"></i>
        Pesan Tiket Baru
      </a>
    </div>

    <!-- Status Filter -->
    <div class="bg-white rounded-xl shadow-md p-4 mb-6" id="status-filter">
      <div class="flex flex-wrap gap-2">
        <button class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium">Semua</button>
        <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">Menunggu Pembayaran</button>
        <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">Terkonfirmasi</button>
        <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">Selesai</button>
        <button class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">Dibatalkan</button>
      </div>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover" id="orders-container">
      <div class="hero-gradient p-5 text-white">
        <h2 class="text-xl font-semibold">Daftar Pesanan</h2>
        <p class="opacity-90">Total {{ $data->count() }} pesanan ditemukan</p>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead class="bg-gray-100 text-gray-700 text-sm uppercase font-medium">
            <tr>
              <th class="p-4 text-left">ID Pesanan</th>
              <th class="p-4 text-left">Penerbangan</th>
              <th class="p-4 text-left">Kelas</th>
              <th class="p-4 text-left">Jumlah</th>
              <th class="p-4 text-left">Total</th>
              <th class="p-4 text-left">Status</th>
              <th class="p-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @foreach($data as $d)
            <tr class="border-t hover:bg-gray-50 transition-colors" id="pesanan-{{ $d->id }}">
              <td class="p-4 font-semibold text-gray-800">
                <div class="flex items-center gap-2">
                  <i class="fas fa-receipt text-red-500"></i>
                  {{ $d->id }}
                </div>
              </td>
              <td class="p-4">
                <div class="font-medium">{{ $d->penerbangan->kode_penerbangan }}</div>
                <div class="text-sm text-gray-500 flex items-center gap-1">
                  <i class="fas fa-plane-departure"></i>
                  {{ $d->penerbangan->asal }} 
                  <i class="fas fa-arrow-right mx-1 text-xs"></i>
                  <i class="fas fa-plane-arrival"></i>
                  {{ $d->penerbangan->tujuan }}
                </div>
                <div class="text-xs text-gray-400 mt-1">
                  {{ \Carbon\Carbon::parse($d->penerbangan->waktu_berangkat)->format('d M Y, H:i') }}
                </div>
              </td>
              <td class="p-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                  {{ $d->kelas->nama_kelas }}
                </span>
              </td>
              <td class="p-4">
                <div class="flex items-center gap-1">
                  <i class="fas fa-users text-gray-400"></i>
                  {{ $d->jumlah_tiket }} Penumpang
                </div>
              </td>
              <td class="p-4 font-semibold text-red-600">
                Rp {{ number_format($d->total_harga,0,',','.') }}
              </td>
              <td class="p-4">
                @if($d->status == 'Selesai')
                  <span class="px-3 py-2 rounded-full bg-green-100 text-green-700 text-sm font-medium flex items-center gap-1 w-fit">
                    <i class="fas fa-check-circle"></i>
                    Selesai
                  </span>
                @elseif($d->status == 'Dibatalkan')
                  <span class="px-3 py-2 rounded-full bg-red-100 text-red-700 text-sm font-medium flex items-center gap-1 w-fit">
                    <i class="fas fa-times-circle"></i>
                    Dibatalkan
                  </span>
                @elseif($d->status == 'Menunggu Pembayaran')
                  <span class="px-3 py-2 rounded-full bg-yellow-100 text-yellow-800 text-sm font-medium flex items-center gap-1 w-fit">
                    <i class="fas fa-clock"></i>
                    Menunggu Bayar
                  </span>
                @else
                  <span class="px-3 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium flex items-center gap-1 w-fit">
                    <i class="fas fa-check"></i>
                    {{ $d->status }}
                  </span>
                @endif
              </td>
              <td class="p-4 text-center">
                <div class="flex flex-col gap-2">
                  @if(!$d->pembayaran)
                    <a href="{{ route('pembayaran.create', $d->id) }}" 
                       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-sm">
                      <i class="fas fa-wallet"></i> Bayar Sekarang
                    </a>
                  @elseif($d->pembayaran->status === 'Diterima')
                    <a href="{{ route('invoice.show', $d->id) }}" 
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors text-sm">
                      <i class="fas fa-file-invoice"></i> Lihat Invoice
                    </a>
                  @else
                    <span class="text-gray-600 text-sm bg-gray-100 px-3 py-2 rounded-lg">
                      {{ $d->pembayaran->status }}
                    </span>
                  @endif
                  
                  <button onclick="showDetail('{{ $d->id }}')" 
                         class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors text-sm">
                    <i class="fas fa-info-circle"></i> Detail
                  </button>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        
        @if($data->count() == 0)
        <div class="text-center py-12" id="empty-state">
          <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-ticket-alt text-gray-400 text-3xl"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Pesanan</h3>
          <p class="text-gray-600 mb-6">Anda belum memiliki pesanan tiket penerbangan.</p>
          <a href="/penerbangan" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors inline-flex items-center gap-2">
            <i class="fas fa-search"></i>
            Cari Penerbangan
          </a>
        </div>
        @endif
      </div>
    </div>

    <!-- Pagination -->
    @if($data->count() > 0)
    <div class="flex justify-center mt-8">
      <div class="flex items-center gap-2 bg-white rounded-lg shadow-md p-2">
        <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
          <i class="fas fa-chevron-left text-gray-600"></i>
        </button>
        
        <button class="w-10 h-10 bg-red-600 text-white rounded-lg flex items-center justify-center font-medium">
          1
        </button>
        
        <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors font-medium">
          2
        </button>
        
        <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors font-medium">
          3
        </button>
        
        <button class="w-10 h-10 border border-gray-300 rounded-lg flex items-center justify-center hover:bg-gray-50 transition-colors">
          <i class="fas fa-chevron-right text-gray-600"></i>
        </button>
      </div>
    </div>
    @endif
  </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-10">
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div>
      <div class="flex items-center gap-3 mb-3">
        <div class="bg-white p-1 rounded-lg">
          <div class="h-8 w-8 bg-red-600 rounded flex items-center justify-center text-white font-bold">ST</div>
        </div>
        <span class="font-bold text-lg">Singa Tanah</span>
      </div>
      <p class="text-gray-400 text-sm mb-4">Maskapai penerbangan terpercaya di Indonesia dengan layanan terbaik untuk perjalanan Anda.</p>
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
      <h3 class="font-semibold mb-3">Tautan Cepat</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
        <li><a href="/penerbangan" class="text-gray-400 hover:text-white transition-colors">Penerbangan</a></li>
        <li><a href="/pemesanan" class="text-gray-400 hover:text-white transition-colors">Pemesanan Saya</a></li>
        <li><a href="/tentang-kami" class="text-gray-400 hover:text-white transition-colors">Tentang Kami</a></li>
      </ul>
    </div>
    
    <div>
      <h3 class="font-semibold mb-3">Layanan</h3>
      <ul class="space-y-2 text-sm">
        <li><a href="/penerbangan" class="text-gray-400 hover:text-white transition-colors">Penerbangan</a></li>
        <li><a href="/status-penerbangan" class="text-gray-400 hover:text-white transition-colors">Status Penerbangan</a></li>
        <li><a href="/bantuan" class="text-gray-400 hover:text-white transition-colors">Bantuan</a></li>
        <li><a href="/kontak" class="text-gray-400 hover:text-white transition-colors">Hubungi Kami</a></li>
      </ul>
    </div>
    
    <div>
      <h3 class="font-semibold mb-3">Kontak</h3>
      <ul class="space-y-2 text-sm">
        <li class="flex items-center gap-2 text-gray-400">
          <i class="fas fa-phone"></i>
          <span>+62 21 6379 8000</span>
        </li>
        <li class="flex items-center gap-2 text-gray-400">
          <i class="fas fa-envelope"></i>
          <span>cs@singatanah.co.id</span>
        </li>
        <li class="flex items-center gap-2 text-gray-400">
          <i class="fas fa-map-marker-alt"></i>
          <span>Jakarta, Indonesia</span>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 text-sm">
    <p>&copy; 2023 Singa Tanah. All rights reserved.</p>
  </div>
</footer>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav md:hidden">
  <a href="/" class="mobile-nav-item">
    <i class="fas fa-home mobile-nav-icon"></i>
    <span>Beranda</span>
  </a>
  <a href="/penerbangan" class="mobile-nav-item">
    <i class="fas fa-search mobile-nav-icon"></i>
    <span>Cari</span>
  </a>
  <a href="/pemesanan" class="mobile-nav-item active">
    <i class="fas fa-ticket-alt mobile-nav-icon"></i>
    <span>Pesanan</span>
  </a>
  <a href="/profile" class="mobile-nav-item">
    <i class="fas fa-user mobile-nav-icon"></i>
    <span>Profil</span>
  </a>
</div>

<script>
  // Profile dropdown functionality
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
  
  // Show detail function
  function showDetail(orderId) {
      alert('Menampilkan detail pesanan ID: ' + orderId);
      // Di sini bisa diimplementasikan modal atau redirect ke halaman detail
  }
  
  // Filter status functionality
  document.querySelectorAll('#status-filter .bg-gray-100').forEach(button => {
      button.addEventListener('click', function() {
          // Remove active class from all buttons
          document.querySelectorAll('#status-filter .bg-gray-100, #status-filter .bg-red-600').forEach(btn => {
              btn.classList.remove('bg-red-600', 'text-white');
              btn.classList.add('bg-gray-100', 'text-gray-700');
          });
          
          // Add active class to clicked button
          this.classList.remove('bg-gray-100', 'text-gray-700');
          this.classList.add('bg-red-600', 'text-white');
          
          // Here you would typically filter the orders based on status
          const status = this.textContent.trim();
          alert('Memfilter pesanan dengan status: ' + status);
      });
  });
</script>

</body>
</html>