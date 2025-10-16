<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Saya - Lion Air</title>
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
  </style>
</head>
<body class="min-h-screen flex flex-col">

<!-- Header -->
<header class="bg-red-600 p-4 text-white shadow-md sticky top-0 z-40">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="bg-white p-1 rounded-lg">
        <img src="{{ asset('images/lionair-logo.png') }}" alt="Lion Air" class="h-8">
      </div>
      <span class="font-bold text-lg">Lion Air</span>
    </div>
    <nav class="hidden md:flex items-center gap-6">
      <a href="#" class="hover:text-red-100">Beranda</a>
      <a href="#" class="hover:text-red-100">Penerbangan</a>
      <a href="#" class="hover:text-red-100">Bantuan</a>
    </nav>
  </div>
</header>

<!-- Main -->
<main class="flex-1 py-10">
  <div class="max-w-6xl mx-auto px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Pemesanan Saya</h1>
    <div class="bg-white rounded-xl shadow-md overflow-hidden card-hover">
      <div class="hero-gradient p-5 text-white">
        <h2 class="text-xl font-semibold">Daftar Pesanan</h2>
        <p class="opacity-90">Lihat status & detail pesanan penerbangan Anda</p>
      </div>

      <div class="overflow-x-auto p-6">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
          <thead class="bg-gray-100 text-gray-700 text-sm uppercase font-medium">
            <tr>
              <th class="p-3 text-left">ID</th>
              <th class="p-3 text-left">Penerbangan</th>
              <th class="p-3 text-left">Kelas</th>
              <th class="p-3 text-left">Jumlah</th>
              <th class="p-3 text-left">Total</th>
              <th class="p-3 text-left">Status</th>
              <th class="p-3 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-gray-700">
            @foreach($data as $d)
            <tr class="border-t hover:bg-gray-50 transition-colors">
              <td class="p-3 font-semibold text-gray-800">{{ $d->id }}</td>
              <td class="p-3">
                {{ $d->penerbangan->kode_penerbangan }}
                <span class="text-sm text-gray-500">
                  ({{ $d->penerbangan->asal }} → {{ $d->penerbangan->tujuan }})
                </span>
              </td>
              <td class="p-3">{{ $d->kelas->nama_kelas }}</td>
              <td class="p-3">{{ $d->jumlah_tiket }}</td>
              <td class="p-3 font-semibold text-red-600">
                Rp {{ number_format($d->total_harga,0,',','.') }}
              </td>
              <td class="p-3">
                @if($d->status == 'Selesai')
                  <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-medium">Selesai</span>
                @elseif($d->status == 'Dibatalkan')
                  <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-medium">Dibatalkan</span>
                @else
                  <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">{{ $d->status }}</span>
                @endif
              </td>
              <td class="p-3 text-center">
                @if(!$d->pembayaran)
                  <a href="{{ route('pembayaran.create', $d->id) }}" 
                     class="inline-flex items-center gap-1 text-red-600 hover:text-red-700 font-semibold">
                    <i class="fas fa-wallet"></i> Bayar
                  </a>
                @elseif($d->pembayaran->status === 'Diterima')
                  <a href="{{ route('invoice.show', $d->id) }}" 
                     class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 font-semibold">
                    <i class="fas fa-file-invoice"></i> Invoice
                  </a>
                @else
                  <span class="text-gray-600 text-sm">{{ $d->pembayaran->status }}</span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white mt-10">
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
    <div>
      <div class="flex items-center gap-3 mb-3">
        <div class="bg-white p-1 rounded-lg">
          <img src="{{ asset('images/lionair-logo.png') }}" alt="Lion Air" class="h-8">
        </div>
        <span class="font-bold text-lg">Lion Air</span>
      </div>
      <p class="text-gray-400 text-sm">Maskapai penerbangan terpercaya di Indonesia.</p>
    </div>
    <div>
      <h3 class="font-semibold mb-3">Informasi</h3>
      <ul class="space-y-1 text-sm">
        <li><a href="#" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
        <li><a href="#" class="text-gray-400 hover:text-white">Bantuan</a></li>
        <li><a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a></li>
      </ul>
    </div>
    <div>
      <h3 class="font-semibold mb-3">Hubungi Kami</h3>
      <p class="text-gray-400 text-sm">Email: cs@lionair.co.id</p>
      <p class="text-gray-400 text-sm">Telepon: +62 21 6379 8000</p>
    </div>
  </div>
  <div class="bg-gray-900 text-center text-gray-400 py-4 text-sm">
    &copy; 2025 Lion Air. All rights reserved.
  </div>
</footer>

</body>
</html>
