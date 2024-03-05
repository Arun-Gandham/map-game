<?php

namespace App\Http\Controllers;

class MapController extends Controller
{
    public function MapView()
    {
        $pageConfigs = ['myLayout' => 'front'];
        return view('templates.pages.map_view', compact('pageConfigs'));

    }
}
