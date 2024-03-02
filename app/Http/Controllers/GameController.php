<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{
    public function list()
    {
        return view('templates.pages.games_list');
    }

    public function add()
    {
        return view('templates.pages.forms.game_form');
    }

    public function datatblesList(Request $request)
    {
        $data = Game::select(['id', 'name', 'max_time', 'image', 'description'])->orderBy('id', 'desc');
        return DataTables::of($data)
            ->addColumn('actions', function (Game $game) {
                return '<div class="d-flex">
                    <a href="' . route('game.delete', $game->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('game.edit', $game->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                </div>';
            })
            ->addColumn('link', function (Game $game) {
                return '<a href="" class="mx-2">Frontend Link</a>';
            })
            ->addColumn('scores', function (Game $game) {
                return '<a href="" class="mx-2">Scores</a>';
            })
            ->rawColumns(['actions', 'link', 'scores'])
            ->make(true);
    }

    public function delete($id)
    {
        $user = Game::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'Game deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $game = Game::where('id', $id)->first();
        if (!$game) {
            return redirect()->back()->with('error', 'User not exist!!!');
        }
        return view('templates.pages.forms.game_form', compact('game'));
    }

    public function editSubmit(Request $req)
    {
        $game = Game::findOrFail($req->id);

        if (!$game) {
            return redirect()->back()->with('error', 'Game not exist!!!');
        }

        $game->name = $req->name;
        $game->max_time = $req->max_time;
        $game->no_of_scores = $req->no_of_scores;
        // Handle image upload if required
        $game->image = $req->file('image')->store('images/games', 'public'); // Example: storing image
        $game->description = $req->description;

        if ($game->save()) {
            return redirect()->route('game.list')->with('success', 'Successfully updated');
        } else {
            return redirect()->route('game.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        // Validate the request data including the uploaded file
        $req->validate([
            'name' => 'required',
            'max_time' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
            'description' => 'required',
        ]);

        // Handle the file upload
        if ($req->hasFile('image')) {
            // Store the uploaded file and get its path
            $imagePath = $req->file('image')->store('images', 'public');

            // Now you can save the $imagePath to your database or perform any other necessary actions
        }

        // Create new game record with validated data
        $game = new Game();
        $game->name = $req->name;
        $game->max_time = $req->max_time;
        $game->image = $imagePath; // Save the file path to the image field in your database
        $game->description = $req->description;
        $game->save();

        // Redirect back with success message
        return redirect()->route('game.list')->with('success', 'Successfully created');
    }

}
