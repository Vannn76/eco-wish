<div>
    @if (session()->has('message'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow text-sm">
        {{ session('message') }}
    </div>
    @endif

    {{-- Form komentar utama --}}
    @auth
    <form wire:submit.prevent="postComment" class="mb-6">
        <textarea wire:model.defer="commentBody" class="w-full p-3 border rounded shadow-sm resize-none" rows="3"
            placeholder="Tulis komentar..."></textarea>
        @error('commentBody') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Kirim</button>
    </form>
    @else
    <div class="text-center text-sm text-gray-500 bg-yellow-100 border border-yellow-300 p-4 rounded mb-6">
        <a href="{{ route('login') }}?redirect_to={{ urlencode(request()->fullUrl()) }}"
            class="font-semibold text-green-700 underline">Login</a> untuk memberikan
        komentar.
    </div>
    @endauth

    {{-- Daftar komentar --}}
    <div class="space-y-6">
        @foreach ($comments as $comment)
        <div class="border rounded p-4 shadow-sm">

            <div class="flex items-center">
                <div class="text-sm text-gray-700 font-semibold">{{ $comment->user->name }}</div>
                {{-- Badge: Pembuat Konten --}}
                @if($comment->user_id === $content->user_id)
                <span class="text-blue-600 text-xs font-medium bg-blue-100 px-2 py-0.5 rounded-full">Pembuat</span>
                @endif

                {{-- Badge: Admin --}}
                @if($comment->user->is_admin)
                <span class="text-red-600 text-xs font-medium bg-red-100 px-2 py-0.5 rounded-full">Admin</span>
                @endif
            </div>
            <p class="mt-2 text-gray-800 text-sm">{{ $comment->body }}</p>
            <div class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</div>

            {{-- Tombol reply --}}
            @auth
            <button wire:click="setReply({{ $comment->id }})"
                class="text-sm text-blue-600 mt-2 hover:underline">Balas</button>

            @if(auth()->user()->is_admin || auth()->id() === $comment->user_id)
            <button wire:click="deleteComment({{ $comment->id }})"
                onclick="return confirm('Yakin ingin menghapus komentar ini?')"
                class="text-xs text-red-600 hover:underline ml-4">Hapus</button>
            @endif

            @endauth

            @if ($replyTo === $comment->id)
            <div class="mt-4 pl-4 border-l">

                <form wire:submit.prevent="postComment">
                    <textarea wire:model.defer="commentBody" class="w-full p-2 border rounded resize-none" rows="2"
                        placeholder="Tulis balasan..."></textarea>
                    @error('commentBody') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                    <div class="flex gap-2 mt-2">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Kirim</button>
                        <button type="button" wire:click="$set('replyTo', null)"
                            class="text-sm text-gray-500 hover:underline">Batal</button>
                    </div>
                </form>
            </div>
            @endif



            {{-- Tampilkan reply-nya jika ada --}}
            @if ($comment->replies->count())
            <div class="mt-4 space-y-4 pl-4 border-l border-gray-200">
                @foreach ($comment->replies as $reply)
                <div class="bg-gray-50 p-3 rounded">

                    <div class="flex items-center">
                        <div class="text-sm text-gray-700 font-semibold">{{ $reply->user->name }}</div>
                        {{-- Badge: Pembuat Konten --}}
                        @if($reply->user_id === $content->user_id)
                        <span
                            class="text-blue-600 text-xs font-medium bg-blue-100 px-2 py-0.5 rounded-full">Pembuat</span>
                        @endif

                        {{-- Badge: Admin --}}
                        @if($reply->user->is_admin)
                        <span class="text-red-600 text-xs font-medium bg-red-100 px-2 py-0.5 rounded-full">Admin</span>
                        @endif
                    </div>
                    <p class="mt-1 text-sm text-gray-800">{{ $reply->body }}</p>
                    <div class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</div>
                    @auth
                    @if(auth()->user()->is_admin || auth()->id() === $reply->user_id)
                    <button wire:click="deleteReplyComment({{ $reply->id }})"
                        onclick="return confirm('Yakin ingin menghapus komentar ini?')"
                        class="text-xs text-red-600 hover:underline">Hapus</button>
                    @endif
                    @endauth
                </div>
                @endforeach
            </div>
            @endif

        </div>
        @endforeach
    </div>
</div>