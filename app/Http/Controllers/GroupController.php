<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    public function list()
    {
        return view('templates.pages.groups_list');
    }

    public function add()
    {
        return Point::where('game_id', '2')->orderBy('id', 'desc')->get();

        return view('templates.pages.forms.group_form');
    }

    public function datatblesList(Request $request)
    {
        $data = Group::select(['id', 'name', 'game_id', 'p_count'])->orderBy('id', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Group $group) {
                return '<div class="d-flex">
                    <a href="' . route('group.delete', $group->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>
                    <span class="border border-right-0 border-light"></span>
                    <a href="' . route('group.edit', $group->id) . '" class="mx-2"><i class="fa-solid fa-edit"></i></a>
                    </div>';
            })
            ->addColumn('link', function (Group $group) {
                return '
                    <a href="" class="mx-2">Frontend Link</a>';
            })
            ->addColumn('scores', function (Group $group) {
                return '
                    <a href="" class="mx-2">Scores</a>';
            })
            ->rawColumns(['actions', 'link', 'scores'])
            ->make(true);
    }

    public function delete($id)
    {
        $user = Group::where('id', $id)->delete();
        if ($user) {
            return redirect()->back()->with('success', 'Group deleted succesfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function edit($id)
    {
        $group = Group::where('id', $id)->first();
        if (!$group) {
            return redirect()->back()->with('error', 'User not exist!!!');
        }
        return view('templates.pages.forms.group_form', compact('group'));
    }

    public function editSubmit(Request $req)
    {
        $group = Group::findOrFail($req->id);

        if (!$group) {
            return redirect()->back()->with('error', 'Group not exist!!!');
        }

        $group->name = $req->name;
        $group->game_id = $req->game_id;
        $group->p_count = $req->p_count;
        $group->date = $req->date;
        $group->description = $req->description;

        if ($group->save()) {
            return redirect()->route('group.list')->with('success', 'Succesfully updated');
        } else {
            return redirect()->route('group.list')->with('error', 'Something went wrong');
        }
    }

    public function addSubmit(Request $req)
    {
        $group = Group::create(
            ['name' => $req->name, 'game_id' => $req->game_id, 'p_count' => $req->p_count, 'date' => $req->date, 'description' => $req->description]
        );

        if ($group) {
            return redirect()->route('group.list')->with('success', 'Succesfully created');
        } else {
            return redirect()->route('group.list')->with('error', 'Something went wrong');
        }
    }
}
