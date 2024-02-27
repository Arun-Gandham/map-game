<?php

namespace App\Http\Controllers;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
        public function List()
    {
        return view('templates.pages.types_list');
    }

    public function add()
    {
        return view('templates.pages.forms.types_form');
    }

    public function datatblesList(Request $request)
    {
        $data = Type::select(['id', 'name' ])->orderBy('id', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Type $type) {
                return '<div class="d-flex">
                        <a href="'.route('type.delete',$type->id).'" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                        <span class="border border-right-0 border-light"></span>
                        <a href="'.route('type.edit',$type->id).'" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                        </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

     public function delete($id)
    {
        $user = Type::where('id',$id)->delete();
        if($user)
        {
            return redirect()->back()->with('success','Type deleted succesfully');
        }

        return redirect()->back()->with('error','Something went wrong');
    }

    public function edit($id)
    {
        $type = Type::where('id',$id)->first();
        if(!$type)
        {
            return redirect()->back()->with('error','User not exist!!!');
        }
        return view('templates.pages.forms.types_form',compact('type'));
    }

    public function editSubmit(Request $req)
    {
        $type = Type::findOrFail($req->id);

        if(!$type)
        {
            return redirect()->back()->with('error','Group not exist!!!');
        }

        $type->name = $req->name;
        $type->color = $req->color;
        $type->description = $req->description;
        
        if($type->save())
        {
            return redirect()->route('type.list')->with('success','Succesfully updated');
        }
        else
        {
            return redirect()->route('type.list')->with('error','Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $type = Type::create(
            ['name' => $req->name,  'color' => $req->color, 'description' => $req->description]
        );

        if($type)
        {
            return redirect()->route('type.list')->with('success','Succesfully created');
        }
        else
        {
            return redirect()->route('type.list')->with('error','Something went wrong');
        }
    }
}
