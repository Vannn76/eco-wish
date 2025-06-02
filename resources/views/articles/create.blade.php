@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Tambah Artikel Baru</h1>

@if ($errors->any())
<div class="text-red-600 mb-4">
    <ul>
        @foreach ($errors->all() as $err)
        <li>{{ $err }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('articles.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label class="block">Judul:</label>
        <input type="text" name="title" value="{{ old('title') }}" class="border p-2 w-full">
    </div>
    <div class="mb-4">
        <label class="block">Isi:</label>
        <textarea name="body" rows="6" class="border p-2 w-full">{{ old('body') }}</textarea>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan Artikel
    </button>
</form>
@endsection