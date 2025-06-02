<!-- resources/views/eco_learn/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Konten Edukasi')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Edit Konten Edukasi</h1>

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="/eco-learn/{{ $content->id }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="title">Judul</label>
            <input type="text" name="title" id="title" value="{{ old('title', $content->title) }}"
                class="w-full border px-4 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="video_url">Link Video (Opsional)</label>
            <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $content->video_url) }}"
                class="w-full border px-4 py-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold" for="content">Isi Artikel (Opsional jika pakai video)</label>
            <textarea name="content" id="content" rows="6"
                class="w-full border px-4 py-2 rounded">{{ old('content', $content->content) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection