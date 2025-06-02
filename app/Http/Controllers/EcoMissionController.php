<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EcoMission;

class EcoMissionController extends Controller
{
    public function index()
    {
        $missions = EcoMission::orderBy('mission_date', 'desc')->get();
        return view('eco_journey.admin.missions.index', compact('missions'));
    }

    public function create()
    {
        return view('eco_journey.admin.missions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'mission_date' => 'required|date',
            'point_reward' => 'required|integer|min:1',
        ]);

        EcoMission::create($request->all());

        return redirect()->route('admin.missions.index')->with('success', 'Misi harian berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $mission = EcoMission::findOrFail($id);
        return view('eco_journey.admin.missions.edit', compact('mission'));
    }

    public function update(Request $request, $id)
    {
        $mission = EcoMission::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'mission_date' => 'required|date',
            'point_reward' => 'required|integer|min:1',
        ]);

        $mission->update($request->only(['title', 'description', 'mission_date', 'point_reward']));

        return redirect()->route('admin.missions.index')->with('success', 'Misi berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $mission = EcoMission::findOrFail($id);
        $mission->delete();

        return redirect()->route('admin.missions.index')->with('success', 'Misi berhasil dihapus.');

    }
}