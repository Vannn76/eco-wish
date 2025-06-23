@extends('layouts.app')

@section('title', 'Artikel oleh ' . $user->name)

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-green-700">Artikel oleh: {{ $user->name }}</h2>
        <a href="{{ route('admin.users.index') }}"
            class="text-sm px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded text-gray-700">← Kembali</a>
    </div>

    @if ($articles->isEmpty())
    <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 p-4 rounded text-sm">
        Belum ada artikel yang ditulis oleh user ini.
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full border rounded-lg shadow-sm text-sm">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($articles as $article)
                <tr>
                    <td class="px-4 py-3 font-semibold">{{ $article->title }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $article->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('eco-learn.show', $article->id) }}" target="_blank"
                            class="text-blue-600 hover:underline">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection