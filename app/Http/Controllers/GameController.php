<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Game;
use Yajra\DataTables\Facades\DataTables;

class GameController extends Controller
{
    public function List()
    {
        return view('templates.pages.games_list');
    }

    public function add()
    {
        return view('templates.pages.forms.game_form');
    }

    public function datatblesList(Request $request)
    
        {
            $data = Game::select(['id', 'name', 'max_time','image'])->orderBy('id','desc'); // Use the Game model and desired columns
            return DataTables::of($data)
                ->addColumn('actions', function(Game $game) {
                    return '<div class="d-flex">
                        <a href="'.route('game.delete', $game->id).'" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                        <span class="border border-right-0 border-light"></span>
                        <a href="'.route('game.edit', $game->id).'" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
                })
                ->addColumn('image', function(Game $game) {
                    return '<div class="">
                    <img src="'.$game->image.'">
                    </div>';
                })
                ->addColumn('link', function(Game $game) {
                    return '<a href="" class="mx-2">Frontend Link</a>';
                })
             
                
                ->rawColumns(['actions', 'link','image'])
                ->make(true);
            }
    
    public function delete($id)
    {
        $user = Game::where('id',$id)->delete();
        if($user)
        {
            return redirect()->back()->with('success','Player deleted succesfully');
        }

        return redirect()->back()->with('error','Something went wrong');
    }

    public function edit($id)
    {
        $game = Game::where('id',$id)->first();
        if(!$game)
        {
            return redirect()->back()->with('error','User not exist!!!');
        }
        return view('templates.pages.forms.game_form',compact('game'));
    }

    public function editSubmit(Request $req)
    {
        $game = Game::findOrFail($req->id);

        if(!$game)
        {
            return redirect()->back()->with('error','game not exist!!!');
        }

        $game->name = $req->name;
        $game-> image= $req->image;
        $game->description = $req->description;
        
        
        if($game->save())
        {
            return redirect()->route('game.list')->with('success','Succesfully updated');
        }
        else
        {
            return redirect()->route('game.list')->with('error','Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        // return $req->all();
        $game = Game::create(
            ['name' => $req->name,   'image'=> $req->image, 'description' => $req->description,'max_time' => $req->max_time]
        );

        if($game)
        {
            return redirect()->route('game.list')->with('success','Succesfully created');
        }
        else
        {
            return redirect()->route('game.list')->with('error','Something went wrong');
        }
    }
}
