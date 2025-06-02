@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 p-4">
    <h2 class="text-2xl font-bold mb-2">{{ $mission->title }}</h2>
    <p class="text-sm text-gray-500 mb-4">{{ $mission->mission_date->format('d M Y') }}</p>
    <p class="mb-6">{{ $mission->description }}</p>

    <h3 class="text-lg font-semibold mb-2">Submit Bukti Misi</h3>
    <form action="{{ route('eco-journey.submit', $mission->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium">Foto Bukti</label>
            <input type="file" name="photo" id="photo" accept="image/*" required
                class="mt-1 block w-full border rounded px-3 py-2">
            <img id="preview" class="mt-3 rounded shadow w-48 hidden" alt="Preview Foto">
        </div>


        <div class="mb-4">
            <label for="caption" class="block text-sm font-medium">Catatan (Opsional)</label>
            <textarea name="caption" id="caption" rows="3"
                class="mt-1 block w-full border rounded px-3 py-2"></textarea>
        </div>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Submit Misi
        </button>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    } else {
        preview.classList.add('hidden');
        preview.src = '';
    }
});
</script>
@endpush

@endsection