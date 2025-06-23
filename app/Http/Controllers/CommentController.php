<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcoLearnContent;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $content = EcoLearnContent::findOrFail($id);

        $content->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
            'parent_id' => $request->parent_id, // ← tambahan ini penting!
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}