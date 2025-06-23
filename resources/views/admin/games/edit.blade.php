@extends('layouts.app')

@section('title', 'Edit Game')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-yellow-700 mb-6">Edit Game</h1>

    <form action="{{ route('admin.games.update', $game->id) }}" method="POST"
        class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-medium text-gray-700">Judul Game</label>
            <input type="text" name="title" id="title" value="{{ old('title', $game->title) }}"
                class="mt-1 block w-full border-gray-300 rounded p-2 shadow-sm" required>
            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="description" class="block font-medium text-gray-700">Deskripsi Singkat</label>
            <textarea name="description" id="description" rows="3"
                class="mt-1 block w-full border-gray-300 rounded p-2 shadow-sm"
                required>{{ old('description', $game->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="link" class="block font-medium text-gray-700">Link Game</label>
            <input type="url" name="link" id="link" value="{{ old('link', $game->link) }}"
                class="mt-1 block w-full border-gray-300 rounded p-2 shadow-sm" required>
            @error('link') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="text-right">
            <a href="{{ route('admin.games.index') }}" class="inline-block text-gray-500 hover:underline mr-4">Batal</a>
            <button type="submit"
                class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">Perbarui</button>
        </div>
    </form>
</div>
@endsection