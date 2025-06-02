@extends('layouts.app')

@section('content')
<div class="max-w-md mx-5 md:mx-auto mt-12">
    <h2 class="text-2xl font-bold mb-6">Register</h2>
    <form method="POST" action="/register" class="space-y-4">
        @csrf
        <input name="name" type="text" placeholder="Name" class="w-full border px-4 py-2 rounded" required />
        <input name="email" type="email" placeholder="Email" class="w-full border px-4 py-2 rounded" required />
        <input name="password" type="password" placeholder="Password" class="w-full border px-4 py-2 rounded"
            required />
        <input name="password_confirmation" type="password" placeholder="Confirm Password"
            class="w-full border px-4 py-2 rounded" required />
        <button class="bg-green-600 text-white px-4 py-2 rounded">Register</button>
    </form>
</div>
@endsection