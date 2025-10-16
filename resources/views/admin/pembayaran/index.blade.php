<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pembayaran - Admin Panel</title>
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
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
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
        
        .hidden-on-load { display: none; }
        
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
        
        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
        }
        
        .info-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border-top: 4px solid #e11d48;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .feature-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .service-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border-left: 4px solid #e11d48;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .floating-action-button {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 9999px;
            background-color: #e11d48;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            z-index: 40;
            transition: all 0.3s ease;
        }
        
        .floating-action-button:hover {
            transform: scale(1.1);
            background-color: #be123c;
        }
        
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
            <a href="{{ route('admin.dashboard') }}" class="font-medium hover:text-red-100 transition-colors">Dashboard</a>
            <a href="{{ route('admin.user.index') }}" class="font-medium hover:text-red-100 transition-colors">Kelola User</a>
            <a href="{{ route('admin.penerbangan.index') }}" class="font-medium hover:text-red-100 transition-colors">Kelola Penerbangan</a>
            <a href="{{ route('admin.pembayaran.index') }}" class="font-medium hover:text-red-100 transition-colors">Kelola Pembayaran</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors">Laporan</a>
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
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.user.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                        <i class="fas fa-users w-5"></i>
                        <span>Kelola User</span>
                    </a>
                    <a href="{{ route('admin.penerbangan.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                        <i class="fas fa-plane w-5"></i>
                        <span>Kelola Penerbangan</span>
                    </a>
                    <a href="{{ route('admin.pembayaran.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                        <i class="fas fa-credit-card w-5"></i>
                        <span>Kelola Pembayaran</span>
                    </a>
                    <a href="#" class="flex items-center gap-2 px-4 py-3 text-sm hover:bg-gray-100 transition-colors">
                        <i class="fas fa-cog w-5"></i>
                        <span>Pengaturan</span>
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
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="md:hidden p-2 rounded-lg hover:bg-red-700 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu closed md:hidden bg-red-600 mt-2 py-3 px-4 rounded-lg shadow-lg">
        <nav class="flex flex-col gap-3">
            <a href="{{ route('admin.dashboard') }}" class="font-medium hover:text-red-100 transition-colors py-1">Dashboard</a>
            <a href="{{ route('admin.user.index') }}" class="font-medium hover:text-red-100 transition-colors py-1">Kelola User</a>
            <a href="{{ route('admin.penerbangan.index') }}" class="font-medium hover:text-red-100 transition-colors py-1">Kelola Penerbangan</a>
            <a href="{{ route('admin.pembayaran.index') }}" class="font-medium hover:text-red-100 transition-colors py-1">Kelola Pembayaran</a>
            <a href="#" class="font-medium hover:text-red-100 transition-colors py-1">Laporan</a>
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
<main class="p-6 flex-1 max-w-7xl mx-auto w-full">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Daftar Pembayaran</h1>
        <p class="text-gray-600">Kelola verifikasi pembayaran pelanggan Lion Air</p>
    </div>

    <!-- Pesan sukses/error -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Action Bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="relative">
                <input type="text" placeholder="Cari pembayaran..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                <option>Filter Status</option>
                <option>Menunggu Verifikasi</option>
                <option>Diterima</option>
                <option>Ditolak</option>
            </select>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <i class="fas fa-info-circle"></i>
            <span>Total: {{ $list->count() }} pembayaran</span>
        </div>
    </div>

    <!-- TABEL PEMBAYARAN -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-4 font-semibold text-gray-700">ID</th>
                        <th class="p-4 font-semibold text-gray-700">User</th>
                        <th class="p-4 font-semibold text-gray-700">Penerbangan</th>
                        <th class="p-4 font-semibold text-gray-700">Kelas</th>
                        <th class="p-4 font-semibold text-gray-700">Metode</th>
                        <th class="p-4 font-semibold text-gray-700">Bukti</th>
                        <th class="p-4 font-semibold text-gray-700">Status</th>
                        <th class="p-4 text-center font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $p)
                        <tr class="border-t border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="p-4 font-medium">#{{ $p->id }}</td>
                            <td class="p-4">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $p->pemesanan && $p->pemesanan->user ? $p->pemesanan->user->name : '—' }}</span>
                                    <span class="text-sm text-gray-500">
                                        {{ $p->pemesanan && $p->pemesanan->user ? $p->pemesanan->user->email : '—' }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-4">
                                {{ $p->pemesanan && $p->pemesanan->penerbangan ? $p->pemesanan->penerbangan->kode_penerbangan : '—' }}
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $p->pemesanan && $p->pemesanan->kelas ? $p->pemesanan->kelas->nama_kelas : '—' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $p->metode_pembayaran ?? '—' }}
                                </span>
                            </td>
                            <td class="p-4">
                                @if(!empty($p->bukti_pembayaran) && file_exists(storage_path('app/public/'.$p->bukti_pembayaran)))
                                    <a href="{{ asset('storage/'.$p->bukti_pembayaran) }}" target="_blank" 
                                       class="btn btn-outline btn-sm text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span class="text-gray-500 text-sm">Tidak ada</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    {{ $p->status == 'Diterima' ? 'bg-green-100 text-green-800' : 
                                    ($p->status == 'Ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    <i class="fas 
                                        {{ $p->status == 'Diterima' ? 'fa-check-circle' : 
                                        ($p->status == 'Ditolak' ? 'fa-times-circle' : 'fa-clock') }} 
                                        mr-1"></i>
                                    {{ $p->status ?? 'Menunggu Verifikasi' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <form action="{{ route('admin.pembayaran.update', $p->id) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                        <option value="Menunggu Verifikasi" @selected($p->status == 'Menunggu Verifikasi')>Menunggu Verifikasi</option>
                                        <option value="Diterima" @selected($p->status == 'Diterima')>Diterima</option>
                                        <option value="Ditolak" @selected($p->status == 'Ditolak')>Ditolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-sync-alt"></i>
                                        Update Status
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-8 text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <i class="fas fa-credit-card text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-lg">Belum ada pembayaran.</p>
                                    <p class="text-sm text-gray-400 mt-2">Semua pembayaran akan muncul di sini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-700 font-medium flex items-center gap-2">
            <i class="fas fa-arrow-left"></i>
            Kembali ke Dashboard
        </a>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12 mt-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-white p-1 rounded-lg">
                        <img src="{{ asset('images/lionair-logo.png') }}" alt="Lion Air" class="h-8">
                    </div>
                    <span class="font-bold text-lg">Lion Air</span>
                </div>
                <p class="text-gray-400 mb-4">Panel Admin Lion Air - Sistem Manajemen Penerbangan</p>
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
                <h3 class="font-semibold text-lg mb-4">Menu Admin</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition-colors">Dashboard</a></li>
                    <li><a href="{{ route('admin.user.index') }}" class="text-gray-400 hover:text-white transition-colors">Kelola User</a></li>
                    <li><a href="{{ route('admin.penerbangan.index') }}" class="text-gray-400 hover:text-white transition-colors">Kelola Penerbangan</a></li>
                    <li><a href="{{ route('admin.pembayaran.index') }}" class="text-gray-400 hover:text-white transition-colors">Kelola Pembayaran</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="font-semibold text-lg mb-4">Bantuan</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Panduan Admin</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a></li>
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
                        <span>admin@lionair.co.id</span>
                    </li>
                    <li class="flex items-center gap-2 text-gray-400">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Jakarta, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; 2023 Lion Air. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Mobile Bottom Navigation -->
<div class="mobile-bottom-nav md:hidden">
    <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item">
        <i class="fas fa-tachometer-alt mobile-nav-icon"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.user.index') }}" class="mobile-nav-item">
        <i class="fas fa-users mobile-nav-icon"></i>
        <span>User</span>
    </a>
    <a href="{{ route('admin.penerbangan.index') }}" class="mobile-nav-item">
        <i class="fas fa-plane mobile-nav-icon"></i>
        <span>Penerbangan</span>
    </a>
    <a href="{{ route('admin.pembayaran.index') }}" class="mobile-nav-item active">
        <i class="fas fa-credit-card mobile-nav-icon"></i>
        <span>Pembayaran</span>
    </a>
</div>

<!-- Floating Action Button -->
<div class="floating-action-button">
    <i class="fas fa-question"></i>
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