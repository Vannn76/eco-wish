<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    // GameController.php
    public function index()
    {
        $games = Game::latest()->get();
        return view('eco_games.index', compact('games'));
    }

}