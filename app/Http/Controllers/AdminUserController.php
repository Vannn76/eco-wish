<?php

// app/Http/Controllers/AdminUserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('ecoLearnContents')->get(); // pastikan relasi sudah ada
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'required|in:0,1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => (int) $request->input('is_admin'),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }


    public function destroy($id)
    {
        // Cegah user menghapus dirinya sendiri
        if (auth()->id() == $id) {
            return redirect()->back()->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }



    public function showUserArticles(User $user)
    {
        $articles = $user->ecoLearnContents()->latest()->get();

        return view('admin.users.articles', [
            'user' => $user,
            'articles' => $articles
        ]);
    }

}