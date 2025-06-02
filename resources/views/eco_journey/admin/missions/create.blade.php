@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-4">Tambah Misi Harian</h2>

    <form action="{{ route('admin.missions.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold">Judul Misi</label>
            <input type="text" name="title" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border rounded p-2" rows="4" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Tanggal Misi</label>
            <input type="date" name="mission_date" class="w-full border rounded p-2" required>
        </div>
        <div class="mb-6">
            <label class="block font-semibold">Poin Reward</label>
            <input type="number" name="point_reward" class="w-full border rounded p-2" min="1" required>
        </div>
        <a href="{{ route('admin.missions.index') }}"
            class="mx-2 px-4 py-2.5 bg-red-600 text-white text-sm rounded hover:bg-red-700">Batal</a>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection