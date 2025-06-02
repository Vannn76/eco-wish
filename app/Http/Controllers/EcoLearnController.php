<?php

namespace App\Http\Controllers;
use App\Models\EcoLearnContent;

use Illuminate\Http\Request;

class EcoLearnController extends Controller
{
    public function index()
    {
        $contents = EcoLearnContent::where('status', 'published')->latest()->get();
        return view('eco_learn.index', compact('contents'));
    }

    public function create()
    {
        return view('eco_learn.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'video_url' => 'nullable|url'
        ]);

        EcoLearnContent::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'status' => 'pending'
        ]);

        return redirect('/eco-learn')->with('success', 'Konten kamu menunggu verifikasi.');
    }
    public function show($id)
    {
        $content = EcoLearnContent::with('user')->findOrFail($id);
        $content->embed_url = null;

        if ($content->video_url && str_contains($content->video_url, 'youtube.com/watch')) {
            parse_str(parse_url($content->video_url, PHP_URL_QUERY), $query);
            $videoId = $query['v'] ?? null;
            if ($videoId) {
                $content->embed_url = 'https://www.youtube.com/embed/' . $videoId;
            }
        } elseif ($content->video_url && str_contains($content->video_url, 'youtu.be/')) {
            $videoId = basename($content->video_url);
            $content->embed_url = 'https://www.youtube.com/embed/' . $videoId;
        }

        if ($content->status !== 'published' && !(auth()->check() && auth()->user()->is_admin)) {
            abort(403, 'Konten belum tersedia untuk publik.');
        }

        $content->formatted = formatParagraphs($content->content);


        return view('eco_learn.show', compact('content'));
    }

    public function edit($id)
    {
        $content = EcoLearnContent::findOrFail($id);

        if (auth()->user()->id !== $content->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        return view('eco_learn.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $content = EcoLearnContent::findOrFail($id);

        if (auth()->user()->id !== $content->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'video_url' => 'nullable|url'
        ]);

        $content->update([
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'status' => auth()->user()->is_admin ? 'published' : 'pending',
        ]);

        return redirect("/eco-learn/{$content->id}")->with('success', 'Konten berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $content = EcoLearnContent::findOrFail($id);
        $content->delete();

        return redirect('/eco-learn')->with('success', 'Konten berhasil dihapus.');
    }


    public function admin()
    {
        $contents = EcoLearnContent::where('status', 'pending')->latest()->get();
        return view('eco_learn.admin', compact('contents'));
    }

    public function approve($id)
    {
        $content = EcoLearnContent::findOrFail($id);
        $content->update(['status' => 'published']);

        return back()->with('success', 'Konten berhasil disetujui.');
    }

    public function reject($id)
    {
        $content = EcoLearnContent::findOrFail($id);
        $content->update(['status' => 'rejected']);

        return back()->with('success', 'Konten berhasil ditolak.');
    }

}