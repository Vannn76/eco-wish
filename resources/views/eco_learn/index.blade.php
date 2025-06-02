<!-- resources/views/eco_learn/index.blade.php -->
@extends('layouts.app')

@section('title', 'Eco Learn')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Eco Learn: Artikel & Video Edukasi</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @auth
    <div class="flex justify-end mb-4">
        <a href="eco-learn/create" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            + Tambah Konten Edukasi
        </a>
    </div>
    @endauth

    @guest
    <div class="flex justify-end mb-4">
        <a href="login" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            + Tambah Konten Edukasi
        </a>
    </div>
    @endguest

    @if($contents->isEmpty())
    <p class="text-gray-600">Belum ada konten edukasi yang tersedia.</p>
    @else
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        @foreach($contents as $content)
        <a href="/eco-learn/{{ $content->id }}"
            class="block bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
            <div class="p-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $content->title }}</h2>
                <p class="text-sm text-gray-500 mb-1">Dibuat Oleh: {{ $content->user->name }}</p>
                <p class="text-sm text-gray-500 mb-1">{{ $content->created_at->format('d M Y') }}</p>
                <p class="text-sm text-gray-600 line-clamp-3">
                    {{ Str::limit(strip_tags($content->content), 100) }}
                </p>
                <div class="mt-3 text-xs text-gray-400">
                    @if($content->video_url)
                    🎥 Video Edukasi
                    @else
                    📄 Artikel
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection