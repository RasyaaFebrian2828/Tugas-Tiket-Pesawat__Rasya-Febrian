<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit User - Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<header class="bg-gray-800 p-4 text-white flex justify-between items-center">
  <div class="text-lg font-semibold">Admin Panel</div>
  <form action="{{ route('logout') }}" method="POST">@csrf
    <button class="bg-red-500 px-3 py-1 rounded">Logout</button>
  </form>
</header>

<main class="p-6">
  <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-semibold mb-4">Edit User</h1>

    <form action="{{ route('admin.user.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Password (opsional)</label>
            <input type="password" name="password" class="w-full border p-2 rounded" placeholder="Biarkan kosong jika tidak ingin mengubah">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-medium">Role</label>
            <select name="role" class="w-full border p-2 rounded" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('role') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-between mt-4">
            <a href="{{ route('admin.user.index') }}" class="text-gray-600 hover:underline">Kembali</a>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Perbarui</button>
        </div>
    </form>
  </div>
</main>

</body>
</html>
