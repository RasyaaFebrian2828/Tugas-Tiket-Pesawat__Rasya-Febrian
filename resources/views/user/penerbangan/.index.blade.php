<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Penerbangan - Singa Tanah</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
<h1 class="text-3xl font-bold mb-6 text-center">Daftar Penerbangan - Singa Tanah</h1>

<div class="overflow-x-auto max-w-7xl mx-auto">
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
        @forelse($penerbangans as $p)
        <tr class="border-b hover:bg-gray-50 transition">
            <td class="px-4 py-2 text-center">{{ $p->kode_penerbangan }}</td>
            <td class="px-4 py-2 text-center font-semibold">Singa Tanah</td>
            <td class="px-4 py-2 text-center">{{ $p->asal }}</td>
            <td class="px-4 py-2 text-center">{{ $p->tujuan }}</td>
            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($p->waktu_berangkat)->format('d M Y H:i') }}</td>
            <td class="px-4 py-2 text-center">{{ \Carbon\Carbon::parse($p->waktu_tiba)->format('d M Y H:i') }}</td>
            <td class="px-4 py-2 text-center font-semibold text-green-600">
                Rp {{ number_format($p->kelas->first()->harga ?? 0,0,',','.') }}
            </td>
            <td class="px-4 py-2 text-center">
                @if($p->kelas->count())
                    @foreach($p->kelas as $kelas)
                        <a href="{{ route('pemesanan.create', $kelas->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded mb-1 inline-block">
                           Pesan {{ $kelas->nama_kelas }}
                        </a>
                    @endforeach
                @else
                    <span class="text-gray-400">Belum ada kelas</span>
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
</body>
</html>