<!-- resources/views/eco_learn/admin.blade.php -->
@extends('layouts.app')

@section('title', 'Verifikasi Konten Edukasi')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Verifikasi Konten Edukasi</h1>

    @if($contents->isEmpty())
    <p class="text-gray-600">Tidak ada konten menunggu verifikasi.</p>
    @else
    <div class="grid md:grid-cols-2 gap-6">
        @foreach($contents as $content)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-800">{{ $content->title }}</h2>
            <p class="text-sm text-gray-500">Dikirim oleh: {{ $content->user->name }}</p>
            <p class="text-sm text-gray-400">Tanggal: {{ $content->created_at->format('d M Y') }}</p>
            <div class="mt-3 text-xs text-gray-400">
                @if($content->video_url)
                🎥 Video Edukasi
                @else
                📄 Artikel
                @endif
            </div>
            <div class="flex gap-2 mt-4">
                <a href="/eco-learn/{{ $content->id }}" target="_blank"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                    Lihat Detail
                </a>
                <form method="POST" action="/admin/eco-learn/{{ $content->id }}/approve">
                    @csrf
                    <button class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Setujui</button>
                </form>
                <form method="POST" action="/admin/eco-learn/{{ $content->id }}/reject">
                    @csrf
                    <button class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Tolak</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection