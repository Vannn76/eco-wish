<!-- resources/views/pages/home.blade.php -->
@extends('layouts.app')

@section('title', 'EcoWish - Home')

@section('content')
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 py-12 grid md:grid-cols-2 gap-8 items-center">
        <div>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                Lets Make The <br /> World <br /> A Better Place
            </h1>
            <p class="text-gray-600">
                Have you ever wondered how you can make the world a better place? Here's a reminder that YOU matter and
                that it's the small things that count.
            </p>
        </div>
        <div>
            <img src="/images/recycle-people.png" alt="Recycling people" class="rounded-lg shadow-md">
        </div>
    </div>
</section>

<section class="bg-green-50 py-12">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <img src="/images/recycle-bag.png" alt="Recycle bag" class="mx-auto mb-4 w-20 h-20">
            <h2 class="text-xl font-bold mb-2">Recycle</h2>
            <p class="text-gray-600 text-sm">
                When you put the whole picture together, recycling is the right thing to do
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <img src="/images/recycle-globe.png" alt="Recycle globe" class="mx-auto mb-4 w-20 h-20">
            <h2 class="text-xl font-bold mb-2">Recycle</h2>
            <p class="text-gray-600 text-sm">
                Everybody wants a better world to live in. Let’s make it happen.
            </p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <img src="/images/electric-car.png" alt="Electric car" class="mx-auto mb-4 w-20 h-20">
            <h2 class="text-xl font-bold mb-2">Friendly Cars</h2>
            <p class="text-gray-600 text-sm">
                The time is right for electric cars. Electric cars are the future.
            </p>
        </div>
    </div>
</section>

<footer class="bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <div class="flex items-center space-x-2">
            <img src="/images/logo.png" alt="Logo" class="w-8 h-8">
            <span class="font-bold text-green-600">EcoWish</span>
        </div>
        <div class="text-sm text-gray-600">
            ©2025 Dummy Terms Privacy
        </div>
        <div class="flex flex-wrap gap-4">
            <a href="#" class="text-gray-600 hover:text-green-600">Blog</a>
            <a href="#" class="text-gray-600 hover:text-green-600">Send Feedback</a>
            <a href="#" class="text-gray-600 hover:text-green-600">About</a>
            <a href="#" class="text-gray-600 hover:text-green-600">Help</a>
        </div>
        <div class="flex space-x-3">
            <a href="#" class="text-green-600"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-green-600"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-green-600"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
</footer>
@endsection