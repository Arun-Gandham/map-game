<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use Hashids\Hashids;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function showGameView($id)
    {
        $hashids = new Hashids(env('HASH_SALT_ID'), 20);
        $game = Game::findOrFail($hashids->decode($id)[0] ?? "-");
        if (!$game) {
            abort(404);
        }
        $pageConfigs = ['myLayout' => 'front'];

        return view('templates.pages.front_game_view', compact('pageConfigs', 'game'));
    }

    public function showGameViewSubmit(Request $req, $id)
    {
        $hashids = new Hashids(env('HASH_SALT_ID'), 20);

        $team = new Team();
        $team->name = $req->team_name;
        $team->game_id = $id;
        if ($team->save()) {
            return redirect()->route('map.view', [$hashids->encode($id), $hashids->encode($team->id)]);
        }
        return "Something went wrong.";
    }
}
