<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use Yajra\DataTables\Facades\DataTables;

class PointController extends Controller
{
    public function add()
    {
        return view('templates.pages.forms.point_form');
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
        $point->latitude = $req->latitude;
        
        $point->distance = $req->distance;
        $point->image = $imagePath ?? null; // Save the file path to the image field in your database
        $point->description = $req->description;
        $point->save();
    
        // Redirect back with success message
        return redirect()->route('game_form')->with('success', 'Successfully created');
    }
    
}
