<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah User - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- HEADER -->
<header class="bg-gray-800 text-white p-4 flex justify-between items-center">
  <h1 class="text-lg font-semibold">Admin Panel</h1>
  <a href="{{ route('admin.dashboard') }}" class="text-sm bg-gray-700 hover:bg-gray-600 px-3 py-1 rounded">
    ← Kembali ke Dashboard
  </a>
</header>

<!-- MAIN CONTENT -->
<main class="flex-grow flex items-center justify-center p-6">
  <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">Tambah User Baru</h2>

      <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
          @csrf

          <!-- Nama -->
          <div>
              <label class="block mb-1 font-medium text-gray-700">Nama</label>
              <input type="text" name="name" value="{{ old('name') }}" 
                     class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
              @error('name')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- Email -->
          <div>
              <label class="block mb-1 font-medium text-gray-700">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" 
                     class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
              @error('email')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- Password -->
          <div>
              <label class="block mb-1 font-medium text-gray-700">Password</label>
              <input type="password" name="password" 
                     class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
              @error('password')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- Role -->
          <div>
              <label class="block mb-1 font-medium text-gray-700">Role</label>
              <select name="role" class="w-full border p-2 rounded focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
                  <option value="">-- Pilih Role --</option>
                  <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
              </select>
              @error('role')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          <!-- BUTTONS -->
          <div class="flex justify-between items-center pt-4">
              <a href="{{ route('admin.user.index') }}" class="text-gray-600 hover:underline">← Kembali</a>
              <button type="submit" 
                      class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded transition">
                  Simpan
              </button>
          </div>
      </form>
  </div>
</main>

<!-- FOOTER -->
<footer class="bg-gray-800 text-center text-white py-2 text-sm">
  &copy; {{ date('Y') }} Admin Panel - Manajemen User
</footer>

</body>
</html>
