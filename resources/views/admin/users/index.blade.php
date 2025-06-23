<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kelola Users')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold mb-6">Kelola Pengguna</h1>
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Role</th>
                    <th class="py-3 px-4 text-left">Jumlah Artikel</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $user->name }}</td>
                    <td class="py-3 px-4">{{ $user->email }}</td>
                    <td class="py-3 px-4">
                        <span
                            class="px-2 py-1 text-sm rounded-full {{ $user->is_admin ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                            {{ $user->is_admin ? 'Admin' : 'User' }}
                        </span>
                    </td>
                    <td class="py-3 px-4">{{ $user->eco_learn_contents_count }}</td>
                    <td class="py-3 px-4">
                        <div class="flex gap-2 justify-start flex-wrap">

                            {{-- Tombol Lihat Artikel --}}
                            <a href="{{ route('admin.users.articles', $user->id) }}"
                                class="bg-green-100 text-green-700 text-sm px-3 py-1 rounded hover:bg-green-200 font-medium shadow-sm">
                                📄 Artikel
                            </a>

                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded hover:bg-yellow-200 font-medium shadow-sm">
                                ✏️ Edit
                            </a>

                            {{-- Tombol Hapus (kecuali dirinya sendiri) --}}
                            @if (auth()->id() !== $user->id)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-100 text-red-700 text-sm px-3 py-1 rounded hover:bg-red-200 font-medium shadow-sm">
                                    🗑️ Hapus
                                </button>
                            </form>
                            @endif

                        </div>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection