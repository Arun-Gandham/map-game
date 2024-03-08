<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
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
        $team = new Team();
        $team->name = $req->team_name;
        $team->game_id = $id;
        if ($team->save()) {
            return redirect()->route('map.view', [$id, $team->id]);
        }
        return "Something went wrong.";

    }
}
