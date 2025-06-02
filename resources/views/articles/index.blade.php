@extends('layouts.app')

@section('content')
<h1 class="text-2xl mb-4">Daftar Artikel</h1>
@foreach ($articles as $art)
<article class="mb-6">
    <h2 class="text-xl">{{ $art->title }}</h2>
    <p>{{ Str::limit($art->body, 150) }}</p>
    <small>Dipost: {{ $art->created_at->format('d M Y') }}</small>
</article>
@endforeach

{{ $articles->links() }}
@endsection