<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Hashids\Hashids;

class MapController extends Controller
{
    public function MapView($id, $team_id)
    {
        $hashids = new Hashids(env('HASH_SALT_ID'), 20);

        $pageConfigs = ['myLayout' => 'front'];
        $points = Point::where('game_id', $hashids->decode($id)[0] ?? '-')->get();
        if (!$points) {
            abort(404);
        }

        $team_id = $hashids->decode($team_id);
        if (!count($team_id)) {
            abort(404);

        } else {
            $team_id = $team_id[0];
        }
        return view('templates.pages.map_view', compact('pageConfigs', 'points', 'team_id'));
    }
}
