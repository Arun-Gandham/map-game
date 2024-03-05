<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function showGameView($id)
    {
        $game = Game::findOrFail($id);
        $pageConfigs = ['myLayout' => 'front'];

        return view('templates.pages.front_game_view', compact('pageConfigs', 'game'));
    }

    public function showGameViewSubmit(Request $req, $id)
    {
        return redirect()->route('map.view', $id);
    }
}
