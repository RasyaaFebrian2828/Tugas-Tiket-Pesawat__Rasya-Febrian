<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Penerbangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Daftar Penerbangan</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2">Kode</th>
                        <th class="px-4 py-2">Maskapai</th>
                        <th class="px-4 py-2">Asal</th>
                        <th class="px-4 py-2">Tujuan</th>
                        <th class="px-4 py-2">Berangkat</th>
                        <th class="px-4 py-2">Tiba</th>
                        <th class="px-4 py-2">Harga</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penerbangan as $p)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-2 text-center">{{ $p->kode_penerbangan }}</td>
                            <td class="px-4 py-2 text-center">{{ $p->maskapai }}</td>
                            <td class="px-4 py-2 text-center">{{ $p->asal }}</td>
                            <td class="px-4 py-2 text-center">{{ $p->tujuan }}</td>
                            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($p->waktu_berangkat)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($p->waktu_tiba)->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 text-center font-semibold text-green-600">
                                Rp {{ number_format($p->harga,0,',','.') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if(Auth::check() && Auth::user()->role == 'user')
                                    @foreach($p->kelas as $kelas)
                                        <a href="{{ route('pemesanan.create', $kelas->id) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded transition mb-1 inline-block">
                                            Pesan {{ $kelas->nama_kelas }}
                                        </a>
                                    @endforeach
                                @else
                                    <span class="text-gray-400">Login untuk pesan</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">
                                Tidak ada penerbangan tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
