<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\EcoLearnContent;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    public EcoLearnContent $content;

    public $comments;
    public $commentBody;
    public $replyTo = null;

    public function mount(EcoLearnContent $content)
    {
        $this->content = $content;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->content->comments()->with(['user', 'replies.user'])->latest()->get();
    }

    public function postComment()
    {
        $this->validate([
            'commentBody' => 'required|string|max:1000',
        ]);

        $comment = $this->content->comments()->create([
            'user_id' => auth()->id(),
            'body' => $this->commentBody,
            'parent_id' => $this->replyTo,
        ]);

        $this->commentBody = '';
        $this->replyTo = null;
        $this->loadComments();
    }

    public function setReply($id)
    {
        $this->replyTo = $id;
    }

    public function render()
    {
        return view('livewire.comments');
    }
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        // Validasi user boleh hapus
        if (Auth::user()->is_admin || Auth::id() === $comment->user_id) {
            $comment->delete();
            $this->loadComments(); // Refresh komentar
            session()->flash('message', 'Komentar berhasil dihapus.');
        } else {
            abort(403, 'Tidak diizinkan');
        }
    }
}