@extends('layouts.app')

@section('content')
<div class="max-w-md mx-5 md:mx-auto mt-12">
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    <form method="POST" action="/login" class="space-y-4">
        @csrf
        <input name="email" type="email" placeholder="Email" class="w-full border px-4 py-2 rounded" required />
        <input name="password" type="password" placeholder="Password" class="w-full border px-4 py-2 rounded"
            required />
        <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Login</button>
    </form>
</div>
@endsection