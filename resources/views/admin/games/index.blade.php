@extends('layouts.app')

@section('title', 'Kelola Game Edukasi')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-green-700">Daftar Game Edukasi</h1>
        <a href="{{ route('admin.games.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">+ Tambah Game</a>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if ($games->isEmpty())
    <p class="text-gray-600">Belum ada game ditambahkan.</p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Judul</th>
                    <th class="py-3 px-4 text-left">Deskripsi</th>
                    <th class="py-3 px-4 text-left">Link</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($games as $game)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4 font-semibold text-gray-800">{{ $game->title }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ Str::limit($game->description, 80) }}</td>
                    <td class="py-3 px-4 text-blue-600 hover:underline">
                        <a href="{{ $game->link }}" target="_blank">Mainkan</a>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex gap-2 justify-start flex-wrap">
                            <a href="{{ route('admin.games.edit', $game) }}"
                                class="inline-block bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus game ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 text-sm transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $games->links() }}
    </div>
    @endif
</div>
@endsection