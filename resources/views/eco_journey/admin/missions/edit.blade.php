@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 px-4">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Edit Misi</h2>

    <form action="{{ route('admin.missions.update', $mission->id,false) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Judul Misi</label>
            <input type="text" name="title" value="{{ old('title', $mission->title) }}" required
                class="mt-1 block w-full border-gray-300 rounded-md p-2 shadow-sm">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" rows="4" required
                class="mt-1 block w-full border-gray-300 rounded-md p-2 shadow-sm">{{ old('description', $mission->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Tanggal Misi</label>
            <input type="date" name="mission_date"
                value="{{ old('mission_date', $mission->mission_date->format('Y-m-d')) }}" required
                class="mt-1 block w-full border-gray-300 rounded-md p-2 shadow-sm">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Poin Reward</label>
            <input type="number" name="point_reward" value="{{ old('point_reward', $mission->point_reward) }}" min="1"
                required class="mt-1 block w-full border-gray-300 rounded-md p-2 shadow-sm">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.missions.index') }}"
                class="mx-2 px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">Batal</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection