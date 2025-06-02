<?php

namespace App\Http\Controllers;

use App\Models\EcoMission;
use App\Models\MissionSubmission;

use Illuminate\Http\Request;

class EcoJourneyController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $missions = EcoMission::where('mission_date', $today)
    ->with('latestUserSubmission')
    ->get();// <- get() instead of first()
        return view('eco_journey.index', compact('missions'));
    }


    public function showMission($id)
    {
        $mission = EcoMission::findOrFail($id);

        $submission = MissionSubmission::where('user_id', auth()->id())
            ->where('mission_id', $mission->id)
            ->latest()
            ->first();

        // Cegah akses kalau sudah submit dan statusnya pending/approved
        if ($submission && in_array($submission->status, ['pending', 'approved'])) {
            return redirect()->route('eco-journey.index')
                ->with('error', 'Kamu sudah mengirimkan submission untuk misi ini.');
        }

        return view('eco_journey.show', compact('mission', 'submission'));
    }

    public function submitMission(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:500',
        ]);

        $path = $request->file('photo')->store('missions', 'public');

        MissionSubmission::create([
            'user_id' => auth()->id(),
            'mission_id' => $id,
            'photo' => $path,
            'caption' => $request->caption,
            'submitted_at' => now(),
        ]);

        return redirect('/eco-journey')->with('success', 'Misi berhasil disubmit, tunggu verifikasi admin.');
    }
}