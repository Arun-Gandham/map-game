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
        // Validate the request data including the uploaded file
        // $req->validate([

        //     'type' => 'required', // Add validation for type
        //     'lat&long' => 'required', // Add validation for latitude
        //     'distance' => 'required|numeric', // Add validation for distance
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
        //     'description' => 'required',
        // ]);

        // Handle the file upload
        if ($req->hasFile('image')) {
            // Store the uploaded file and get its path
            $imagePath = $req->file('image')->store('images', 'public');
        }

        // Create new game record with validated data
        $point = new Point();
        $point->type = $req->type;
        $point->lat_long = $req->latitude;
        $point->game_id = $req->game_id;
        $point->title = $req->title;

        $point->distance = $req->distance;
        $point->image = $imagePath ?? null; // Save the file path to the image field in your database
        $point->description = $req->description;
        $point->question = $req->description;
        $point->question_des = $req->description;

        $point->save();

        // Redirect back with success message
        return redirect()->route('game.edit', $req->game_id)->with('success', 'Successfully created');
    }

    public function datatblesList($id)
    {
        $data = Point::where('game_id', $id)->orderBy('id', 'desc')->get(); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Point $point) {
                return '<div class="d-flex">
                    <a href="' . route('group.delete', $point->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('group.edit', $point->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->addColumn('type_name', function (Point $point) {
                return $point->type_obj->name;
            })
            ->addColumn('points', function (Point $point) {
                return '-';
            })
            ->rawColumns(['actions'])
            ->make(true);

    }

}
