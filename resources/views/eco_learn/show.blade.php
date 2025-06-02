<!-- resources/views/eco_learn/show.blade.php -->
@extends('layouts.app')

@section('title', $content->title)

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-green-700 mb-4">{{ $content->title }}</h1>
    <p class="text-sm text-gray-500 mb-2">Dibuat oleh: {{ $content->user->name }}</p>
    <p class="text-sm text-gray-400 mb-4">Tanggal dibuat: {{ $content->created_at->format('d M Y') }}</p>

    @if(auth()->check() && (auth()->user()->is_admin || auth()->id() === $content->user_id))
    <div class="flex gap-2 mb-6">
        <a href="/eco-learn/{{ $content->id }}/edit"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">Edit</a>

        <form method="POST" action="/eco-learn/{{ $content->id }}"
            onsubmit="return confirm('Yakin ingin menghapus konten ini?');">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
        </form>
    </div>
    @endif

    @if($content->video_url)
    <div class="mb-6 aspect-video">
        <iframe src="{{ $content->video_url }}" frameborder="0" class="w-full h-full rounded" allowfullscreen></iframe>
    </div>
    @endif

    @if($content->formatted)
    <div class="prose max-w-none text-justify">
        {!! $content->formatted !!}
    </div>

    @endif

</div>
@endsection