<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice #{{ $pemesanan->id }} - Singa Tanah</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
  </style>
</head>
<body class="min-h-screen flex flex-col">

<!-- Header -->
<header class="bg-red-600 p-4 text-white shadow-md sticky top-0 z-40">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="bg-white p-1 rounded-lg">
        <img src="{{ asset('images/lionair-logo.png') }}" alt="Singa Tanah" class="h-8">
      </div>
      <span class="font-bold text-lg">Singa Tanah</span>
    </div>
    <nav class="hidden md:flex items-center gap-6">
      <a href="{{ url('/') }}" class="hover:text-red-100">Beranda</a>
      <a href="{{ route('pemesanan.index') }}" class="hover:text-red-100">Pemesanan</a>
      <a href="#" class="hover:text-red-100">Kontak</a>
    </nav>
  </div>
</header>

<!-- Main Content -->
<main class="flex-1 py-12">
  <div class="max-w-3xl mx-auto px-4">
    <div class="bg-white rounded-xl shadow-md card-hover overflow-hidden">
      <!-- Header Invoice -->
      <div class="hero-gradient p-6 text-white flex justify-between items-center">
        <div>
          <h1 class="text-2xl font-semibold">Invoice Pemesanan</h1>
          <p class="text-sm opacity-80">Nomor: #{{ $pemesanan->id }}</p>
        </div>
        <div class="text-right">
          <p class="text-sm opacity-80">Tanggal</p>
          <p class="font-semibold">{{ now()->format('d M Y') }}</p>
        </div>
      </div>

      <!-- Body -->
      <div class="p-6 space-y-6">
        <!-- Detail Pemesan -->
        <div>
          <h2 class="font-semibold text-gray-800 mb-2">Data Pemesan</h2>
          <div class="text-gray-700">
            <p>Nama: <span class="font-medium">{{ $pemesanan->user->name ?? '—' }}</span></p>
            <p>Email: <span class="font-medium">{{ $pemesanan->user->email ?? '—' }}</span></p>
          </div>
        </div>

        <!-- Detail Penerbangan -->
        <div>
          <h2 class="font-semibold text-gray-800 mb-2">Detail Penerbangan</h2>
          <div class="text-gray-700">
            <p>
              {{ $pemesanan->penerbangan->kode_penerbangan ?? '—' }} | 
              {{ $pemesanan->penerbangan->asal ?? '—' }} → {{ $pemesanan->penerbangan->tujuan ?? '—' }}
            </p>
            <p>Berangkat: 
              {{ $pemesanan->penerbangan ? \Carbon\Carbon::parse($pemesanan->penerbangan->waktu_berangkat)->format('d M Y H:i') : '—' }}
            </p>
            <p>Tiba: 
              {{ $pemesanan->penerbangan ? \Carbon\Carbon::parse($pemesanan->penerbangan->waktu_tiba)->format('d M Y H:i') : '—' }}
            </p>
          </div>
        </div>

        <!-- Detail Kelas -->
        <div>
          <h2 class="font-semibold text-gray-800 mb-2">Kelas & Jumlah</h2>
          <div class="text-gray-700">
            <p>{{ $pemesanan->kelas->nama_kelas ?? '—' }} — {{ $pemesanan->jumlah_tiket ?? 0 }} tiket</p>
            <p>Harga per tiket: Rp {{ number_format($pemesanan->kelas->harga ?? 0,0,',','.') }}</p>
            <p class="font-semibold text-red-600 mt-1">
              Total: Rp {{ number_format($pemesanan->total_harga ?? 0,0,',','.') }}
            </p>
          </div>
        </div>

        <!-- Status Pembayaran -->
        <div>
          <h2 class="font-semibold text-gray-800 mb-2">Status Pembayaran</h2>
          @php
            $status = $pemesanan->pembayaran->status ?? 'Menunggu Verifikasi';
          @endphp
          <p class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
            {{ $status === 'Diterima' ? 'bg-green-100 text-green-700' : 
               ($status === 'Ditolak' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
            {{ $status }}
          </p>
        </div>

        <!-- Footer teks -->
        <div class="border-t pt-4 text-gray-700">
          <p>Terima kasih telah melakukan pembayaran di <span class="font-semibold">Singa Tanah</span>.</p>
          <p class="text-sm text-gray-500">Simpan halaman ini sebagai bukti pemesanan Anda.</p>
        </div>
      </div>

      <!-- Tombol Kembali -->
      <div class="bg-gray-50 p-6 text-center">
        <a href="{{ url('/') }}" 
           class="inline-flex items-center gap-2 bg-red-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-red-700 transition">
          <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-12">
  <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
    <div>
      <div class="flex items-center gap-3 mb-3">
        <div class="bg-white p-1 rounded-lg">
          <img src="{{ asset('images/lionair-logo.png') }}" alt="Singa Tanah" class="h-8">
        </div>
        <span class="font-bold text-lg">Singa Tanah</span>
      </div>
      <p class="text-gray-400 text-sm">Maskapai penerbangan terpercaya di Indonesia.</p>
    </div>
    <div>
      <h3 class="font-semibold mb-3">Informasi</h3>
      <ul class="space-y-1 text-sm">
        <li><a href="#" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
        <li><a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a></li>
        <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-semibold mb-3">Hubungi Kami</h3>
      <p class="text-gray-400 text-sm">Email: cs@singatanah.co.id</p>
      <p class="text-gray-400 text-sm">Telepon: +62 21 6379 8000</p>
    </div>
  </div>
  <div class="bg-gray-900 text-center text-gray-400 py-4 text-sm">
    &copy; 2025 Singa Tanah. All rights reserved.
  </div>
</footer>

</body>
</html>