@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-4 text-green-700">Daftar Misi Harian</h2>
    <a href="{{ route('admin.missions.create') }}"
        class="inline-block bg-green-600 text-white px-4 py-2 rounded mb-6 hover:bg-green-700">
        + Tambah Misi
    </a>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
        <strong class="font-bold">Berhasil!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif
    @if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
        <strong class="font-bold">Gagal!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    @php
    $grouped = $missions->sortByDesc('mission_date')->groupBy(function ($item) {
    return \Carbon\Carbon::parse($item->mission_date)->format('d F Y');
    });
    @endphp

    @forelse ($grouped as $date => $missionsByDate)
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-2 border-b pb-1">📅 {{ $date }}</h3>
        <div class="space-y-4">
            @foreach ($missionsByDate as $mission)
            <div class="bg-white shadow-sm border p-4 rounded-lg">
                <h4 class="text-md font-semibold text-green-800">{{ $mission->title }}</h4>
                <p class="text-sm text-gray-600 mt-1 mb-2">🎯 {{ $mission->point_reward }} poin</p>
                <p class="text-sm text-gray-700">{{ $mission->description }}</p>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('admin.missions.edit', $mission->id) }}"
                        class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">Edit</a>
                    <form action="{{ route('admin.missions.destroy', $mission->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus misi ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <p class="text-gray-600">Belum ada misi yang tersedia.</p>
    @endforelse
</div>
@endsection