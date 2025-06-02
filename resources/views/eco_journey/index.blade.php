@extends('layouts.app')

@section('title', 'Eco Learn')

@section('content')
<div x-data="{ openMission: false, showPointModal: false }"
    class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100">
    <div class="max-w-4xl mx-auto px-4 py-6 sm:py-8">

        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <span class="text-2xl">🌱</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-green-800 mb-2">Eco Journey</h1>
            <p class="text-green-600 text-sm sm:text-base">Misi Harian & Sharing Pengalaman</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 shadow-sm">
            <div class="flex items-center">
                <span class="text-green-500 mr-2">✓</span>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-sm">
            <div class="flex items-center">
                <span class="text-red-500 mr-2">⚠</span>
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Mission Button -->
        <div class="flex justify-center space-x-5 mb-8">
            <button @click="openMission = true"
                class="group relative bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-out">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl group-hover:animate-bounce">🌱</span>
                    <span class="font-semibold text-lg">Lihat Misi Harian</span>
                </div>
                <div
                    class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 rounded-2xl transition-opacity duration-300">
                </div>
            </button>
            @auth
            <button @click="showPointModal = true"
                class="bg-gradient-to-r from-yellow-300 via-yellow-200 to-yellow-300 text-yellow-900 font-semibold text-sm px-4 py-1 rounded-full shadow-md hover:shadow-lg transition-all duration-200">
                🌟 Total Poin: {{ auth()->user()->totalEcoPoints() }}
            </button>
            @endauth
        </div>

        <!-- Today's Info Card -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-green-100 mb-8">
            <div class="text-center">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Hari ini</h2>
                <p class="text-2xl font-bold text-green-700">{{ now()->format('d F Y') }}</p>
                <p class="text-sm text-gray-500 mt-1">Mari berkontribusi untuk lingkungan!</p>
            </div>
        </div>
    </div>

    <!-- Modal Riwayat Poin -->
    <div x-show="showPointModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-cloak
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-black/50 backdrop-blur-sm p-4">

        <div @click.outside="showPointModal = false" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-full sm:translate-y-0 sm:scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 sm:scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0 sm:scale-100 opacity-100"
            x-transition:leave-end="translate-y-full sm:translate-y-0 sm:scale-95 opacity-0"
            class="bg-white w-full max-w-lg max-h-[90vh] rounded-t-3xl sm:rounded-2xl shadow-2xl overflow-hidden">

            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white p-6 pb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Riwayat Poin</h3>
                        <p class="text-yellow-100 text-sm">Total:
                            {{ auth()->check() ? auth()->user()->totalEcoPoints() : 0 }} poin</p>
                    </div>
                    <button @click="showPointModal = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                @auth
                @php
                $approved = \App\Models\MissionSubmission::with('mission')
                ->where('user_id', auth()->id())
                ->where('status', 'approved')
                ->latest()
                ->take(10)
                ->get();
                @endphp

                @if($approved->isEmpty())
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🌟</span>
                    </div>
                    <p class="text-gray-600 text-sm">Belum ada poin yang dikumpulkan.</p>
                    <p class="text-gray-500 text-xs mt-1">Selesaikan misi untuk mendapatkan poin!</p>
                </div>
                @else
                <div class="space-y-3">
                    @foreach($approved as $submission)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">{{ $submission->mission->title }}</p>
                            <p class="text-xs text-gray-500">{{ $submission->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <span class="text-green-600 font-semibold text-sm ml-3">
                            +{{ $submission->mission->point_reward }} pts
                        </span>
                    </div>
                    @endforeach
                </div>
                @endif
                @else
                <div class="text-center py-8">
                    <p class="text-gray-600 text-sm">Silakan login untuk melihat riwayat poin Anda.</p>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Modal Misi Harian -->
    <div x-show="openMission" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center bg-black/50 backdrop-blur-sm p-4">

        <div @click.outside="openMission = false" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-y-full sm:translate-y-0 sm:scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 sm:scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="translate-y-0 sm:scale-100 opacity-100"
            x-transition:leave-end="translate-y-full sm:translate-y-0 sm:scale-95 opacity-0"
            class="bg-white w-full max-w-lg max-h-[90vh] rounded-t-3xl sm:rounded-2xl shadow-2xl overflow-hidden">

            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 pb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Misi Harian</h3>
                        <p class="text-green-100 text-sm">{{ now()->format('d F Y') }}</p>
                    </div>
                    <button @click="openMission = false"
                        class="w-8 h-8 flex items-center justify-center rounded-full bg-white/20 hover:bg-white/30 transition-colors duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Content -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                @forelse($missions as $index => $mission)
                @php
                $submission = $mission->latestUserSubmission;
                $canSubmit = !$submission || $submission->status === 'rejected';
                @endphp

                <div
                    class="bg-gradient-to-br from-gray-50 to-green-50/50 rounded-2xl p-5 mb-4 border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <!-- Mission Header -->
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold text-green-600">#{{ $index + 1 }}</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg leading-tight">{{ $mission->title }} -
                                    {{ $mission->point_reward }} poin
                                </h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $mission->mission_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Mission Description -->
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 pl-13">{{ $mission->description }}</p>

                    <!-- Status Badge -->
                    <div class="mb-4 pl-13">
                        @if($submission)
                        @if ($submission->status === 'pending')
                        <div
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                            Menunggu verifikasi
                        </div>
                        @elseif ($submission->status === 'approved')
                        <div
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Selesai
                        </div>
                        @elseif ($submission->status === 'rejected')
                        <div
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Ditolak - bisa submit ulang
                        </div>
                        @endif
                        @else
                        <div
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            <div class="w-2 h-2 bg-gray-400 rounded-full mr-2"></div>
                            Belum ada submission
                        </div>
                        @endif
                    </div>

                    <!-- Submission Form -->
                    @if ($canSubmit)
                    <div class="bg-white rounded-xl p-4 border border-gray-200">
                        <form action="{{ route('eco-journey.submit', $mission->id) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-4">
                            @csrf

                            <!-- Photo Upload -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    📸 Foto Bukti *
                                </label>
                                <div class="relative">
                                    <input type="file" name="photo" required accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                </div>
                            </div>

                            <!-- Caption -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    📝 Catatan (Opsional)
                                </label>
                                <textarea name="caption" rows="3" placeholder="Ceritakan pengalaman Anda..."
                                    class="block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none"></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold shadow-md hover:shadow-lg transform hover:scale-[1.02] transition-all duration-200">
                                🚀 Submit Misi
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-3xl">🌱</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Misi</h3>
                    <p class="text-gray-500 text-sm">Belum ada misi harian untuk hari ini. Coba lagi nanti!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection