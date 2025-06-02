@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6 text-green-700">Submission User</h2>

    {{-- Filter Tanggal --}}
    <form method="GET" action="" class="mb-6 flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <label class="block font-medium text-sm">Filter Tanggal:
            <input type="date" name="date" value="{{ request('date') }}" class="border rounded px-3 py-2 mt-1 text-sm">
        </label>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Filter</button>
    </form>

    @php
    $grouped = $submissions->groupBy(function ($item) {
    return \Carbon\Carbon::parse($item->created_at)->format('d F Y');
    });
    @endphp

    @forelse($grouped as $date => $groupSubmissions)
    <h3 class="text-lg font-semibold text-gray-700 mb-3 border-b pb-1">📅 {{ $date }}</h3>
    <div class="space-y-4 mb-6">
        @foreach ($groupSubmissions as $submission)
        <div class="bg-white border shadow-sm rounded-lg p-4">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                <div>
                    <p class="text-sm"><strong>User:</strong> {{ $submission->user->name }}</p>
                    <p class="text-sm"><strong>Misi:</strong> {{ $submission->mission->title }}</p>
                    <p class="text-sm"><strong>Catatan:</strong> {{ $submission->caption ?? '-' }}</p>
                    <p class="text-sm"><strong>Waktu Submit:</strong>
                        {{ $submission->created_at->format('d M Y H:i') }}</p>
                    <p class="text-sm"><strong>Point Reward:</strong>
                        {{ $submission->mission->point_reward }} poin</p>
                    <p class="text-sm mt-2"><strong>Status:</strong>
                        <span class="uppercase font-semibold {{
                        $submission->status === 'pending' ? 'text-yellow-600' : (
                            $submission->status === 'approved' ? 'text-green-600' : 'text-red-600') }}">
                            {{ $submission->status }}
                        </span>
                    </p>
                </div>
                <div class="w-full sm:w-48 mt-2 sm:mt-0">
                    <img src="{{ asset('storage/' . $submission->photo) }}" class="rounded shadow w-full"
                        alt="Submission Photo">
                </div>
            </div>

            @if ($submission->status === 'pending')
            <div class="mt-4 flex gap-2">
                <form action="{{ route('admin.submissions.approve', $submission->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Approve</button>
                </form>
                <form action="{{ route('admin.submissions.reject', $submission->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Reject</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @empty
    <p class="text-gray-600">Belum ada submission ditemukan.</p>
    @endforelse
</div>
@endsection