<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MissionSubmission;

class EcoSubMissionController extends Controller
{
    public function index(Request $request)
    {
        $query = MissionSubmission::with('user', 'mission')->latest();

        if ($request->has('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $submissions = $query->get();

        return view('eco_journey.admin.submissions.index', compact('submissions'));
    }

    public function approve($id)
    {
        $submission = MissionSubmission::findOrFail($id);
        $submission->status = 'approved';
        $submission->save();

        return back()->with('success', 'Submission telah disetujui.');
    }

    public function reject($id)
    {
        $submission = MissionSubmission::findOrFail($id);
        $submission->status = 'rejected';
        $submission->save();

        return back()->with('success', 'Submission telah ditolak.');
    }

}