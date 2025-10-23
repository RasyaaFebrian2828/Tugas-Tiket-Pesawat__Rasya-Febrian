<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin Dashboard - Singa Tanah</title>
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
    
    .stat-card {
      background: white;
      border-radius: 0.75rem;
      padding: 1.5rem;
      text-align: center;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      border-top: 4px solid #e11d48;
    }
    
    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: #e11d48;
      margin-bottom: 0.5rem;
    }
    
    .stat-label {
      font-size: 0.875rem;
      color: #6b7280;
      font-weight: 500;
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
    
    .btn-secondary {
      background-color: #3b82f6;
      color: white;
      border: 1px solid #3b82f6;
    }
    
    .btn-secondary:hover {
      background-color: #2563eb;
      border-color: #2563eb;
    }
    
    .btn-warning {
      background-color: #f59e0b;
      color: white;
      border: 1px solid #f59e0b;
    }
    
    .btn-warning:hover {
      background-color: #d97706;
      border-color: #d97706;
    }
    
    .btn-success {
      background-color: #10b981;
      color: white;
      border: 1px solid #10b981;
    }
    
    .btn-success:hover {
      background-color: #059669;
      border-color: #059669;
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
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- HEADER -->
<header class="hero-gradient p-4 text-white sticky top-0 z-40 shadow-md">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="bg-white p-1 rounded-lg">
        <img src="{{ asset('images/singatTanah-logo.png') }}" alt="Singa Tanah" class="h-8">
      </div>
      <span class="font-bold text-lg">Singa Tanah - Admin Panel</span>
    </div>

    <div class="flex items-center gap-3">
      <!-- Notification Bell -->
      <div class="relative">
        <button class="p-2 rounded-full hover:bg-red-700 transition-colors">
          <i class="fas fa-bell"></i>
        </button>
        <span class="absolute top-0 right-0 bg-white text-red-600 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold">3</span>
      </div>
      
      <!-- User Profile -->
      <div class="flex items-center gap-2 bg-white text-red-600 px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-user-shield"></i>
        <span>{{ auth()->user()->name }}</span>
      </div>
      
      <!-- Logout -->
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-white text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors flex items-center gap-2">
          <i class="fas fa-sign-out-alt"></i>
          Logout
        </button>
      </form>
    </div>
  </div>
</header>

<!-- MAIN CONTENT -->
<main class="p-6 flex-1 max-w-7xl mx-auto w-full">
  <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>

  <!-- STAT CARDS -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="stat-card card-hover">
      <div class="stat-number">{{ $totalUser }}</div>
      <div class="stat-label">Total User</div>
      <div class="mt-3">
        <i class="fas fa-users text-2xl text-gray-300"></i>
      </div>
    </div>

    <div class="stat-card card-hover">
      <div class="stat-number">{{ $totalPenerbangan }}</div>
      <div class="stat-label">Total Penerbangan</div>
      <div class="mt-3">
        <i class="fas fa-plane text-2xl text-gray-300"></i>
      </div>
    </div>

    <div class="stat-card card-hover">
      <div class="stat-number">{{ $totalPemesanan }}</div>
      <div class="stat-label">Total Pemesanan</div>
      <div class="mt-3">
        <i class="fas fa-ticket-alt text-2xl text-gray-300"></i>
      </div>
    </div>

    <div class="stat-card card-hover">
      <div class="stat-number">{{ $pembayaranMenunggu }}</div>
      <div class="stat-label">Pembayaran Menunggu</div>
      <div class="mt-3">
        <i class="fas fa-clock text-2xl text-gray-300"></i>
      </div>
    </div>
  </div>

  <!-- ACTION BUTTONS -->
  <div class="bg-white rounded-xl shadow-md p-6 mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Kelola Sistem</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <a href="{{ route('admin.penerbangan.index') }}" 
         class="btn btn-primary">
         <i class="fas fa-plane"></i>
         Kelola Penerbangan
      </a>

      <a href="{{ route('admin.pembayaran.index') }}" 
         class="btn btn-warning">
         <i class="fas fa-credit-card"></i>
         Kelola Pembayaran
      </a>

      <a href="{{ route('admin.user.index') }}" 
         class="btn btn-success">
         <i class="fas fa-users"></i>
         Kelola User
      </a>

      <a href="{{ route('home') }}" 
         class="btn btn-outline">
         <i class="fas fa-globe"></i>
         Lihat Situs
      </a>
    </div>
  </div>

  <!-- QUICK STATS -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-md p-6">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terbaru</h2>
      <div class="space-y-4">
        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
          <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
            <i class="fas fa-user-plus"></i>
          </div>
          <div>
            <p class="font-medium text-gray-800">User baru terdaftar</p>
            <p class="text-sm text-gray-600">2 jam yang lalu</p>
          </div>
        </div>
        
        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
          <div class="bg-green-100 text-green-600 p-2 rounded-full">
            <i class="fas fa-plane-departure"></i>
          </div>
          <div>
            <p class="font-medium text-gray-800">Penerbangan baru ditambahkan</p>
            <p class="text-sm text-gray-600">5 jam yang lalu</p>
          </div>
        </div>
        
        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
          <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
            <i class="fas fa-money-bill-wave"></i>
          </div>
          <div>
            <p class="font-medium text-gray-800">Pembayaran baru menunggu verifikasi</p>
            <p class="text-sm text-gray-600">1 hari yang lalu</p>
          </div>
        </div>
      </div>
    </div>

    <!-- System Status -->
    <div class="bg-white rounded-xl shadow-md p-6">
      <h2 class="text-xl font-bold text-gray-800 mb-4">Status Sistem</h2>
      <div class="space-y-4">
        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
          <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
            <span class="font-medium text-gray-800">Server</span>
          </div>
          <span class="text-sm text-green-600 font-medium">Online</span>
        </div>
        
        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
          <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
            <span class="font-medium text-gray-800">Database</span>
          </div>
          <span class="text-sm text-green-600 font-medium">Connected</span>
        </div>
        
        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
          <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
            <span class="font-medium text-gray-800">Payment Gateway</span>
          </div>
          <span class="text-sm text-green-600 font-medium">Active</span>
        </div>
        
        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
          <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
            <span class="font-medium text-gray-800">Backup</span>
          </div>
          <span class="text-sm text-yellow-600 font-medium">Pending</span>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- FOOTER -->
<footer class="bg-gray-800 text-white py-6 mt-8">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <p>&copy; 2023 Singa Tanah Admin Panel. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
