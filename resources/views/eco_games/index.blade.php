@extends('layouts.app')

@section('title', 'Game Edukasi Lingkungan')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-green-700 mb-6 text-center">🎮 Game Edukasi Lingkungan</h1>
    <p class="text-center text-gray-600 mb-10">
        Asah pengetahuan dan kepedulianmu terhadap lingkungan dengan game-game seru di bawah ini!
    </p>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($games as $game)
        <div class="bg-white rounded-lg shadow-md p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold text-green-800 mb-2">{{ $game->title }}</h2>
                <p class="text-sm text-gray-600 mb-4">{{ $game->description }}</p>
            </div>
            <div class="mt-auto text-right">
                <a href="{{ $game->link }}" target="_blank"
                    class="inline-block bg-green-600 text-white text-sm px-4 py-2 rounded hover:bg-green-700 transition">
                    Mainkan Sekarang →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-500">Belum ada game tersedia untuk saat ini.</div>
        @endforelse
    </div>
</div>
@endsection