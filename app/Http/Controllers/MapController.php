<?php

namespace App\Http\Controllers;

use App\Models\Point;

class MapController extends Controller
{
    public function MapView($id, $team_id)
    {
        $pageConfigs = ['myLayout' => 'front'];
        $points = Point::where('game_id', $id)->get();
        return view('templates.pages.map_view', compact('pageConfigs', 'points', 'team_id'));
    }
}
