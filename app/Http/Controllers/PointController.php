<?php

namespace App\Http\Controllers;


use App\Models\Point;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PointController extends Controller
{
    public function add($id)
    {
        $types = Type::all();
        return view('templates.pages.forms.point_form', compact('types', 'id'));
    }
    public function addSubmit(Request $req)
    {

        // return $req->all();
        // Validate the request data including the uploaded file
        // $req->validate([

        //     'type' => 'required', // Add validation for type
        //     'lat&long' => 'required', // Add validation for latitude
        //     'distance' => 'required|numeric', // Add validation for distance
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
        //     'description' => 'required',
        // ]);

        // Handle the file upload
        

        // Create new game record with validated data
        $point = new Point();
        $point->type = $req->type;
        $point->lat_long = $req->latitude;
        $point->game_id = $req->game_id;
        $point->title = $req->title;

        $point->distance = $req->distance;
        $point->image = null; // Save the file path to the image field in your database
        $point->description = $req->description;
        $point->question = $req->question;
        $point->question_des = $req->question_des;
        $point->question_des = $req->question_des;
        $options = [];
        foreach ($req->options as $key => $optionEach) {
            $options[$key] = $optionEach['option'];
        }
        
        $point->options = serialize($options);
        if($point->save())
        {
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("uploads/points/{$point->id}"), $filename);
                $point->image = "uploads/points/{$point->id}/".$filename;
            }
            $point->save();
        }

        // Redirect back with success message
        return redirect()->route('game.edit', $req->game_id)->with('success', 'Successfully created');
    }

    public function datatblesList($id)
    {
        $data = Point::where('game_id', $id)->orderBy('id', 'desc')->get(); // Replace with your model and desired columns
        return DataTables::of($data)

            ->addColumn('type_name', function (Point $point) {
                return $point->type_obj->name;
            })
            ->addColumn('points', function (Point $point) {
                return '-';
            })
            ->rawColumns(['actions'])
            ->make(true);


    }
    public function delete($id)
    {
        $user = Point::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'Game deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $game = Point::where('id', $id)->first();
        if (!$game) {
            return redirect()->back()->with('error', 'User not exist!!!');
        }
        return view('templates.pages.forms.game_list', compact('game'));
    }

   
    

}
