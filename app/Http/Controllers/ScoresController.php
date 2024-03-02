<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ScoresController extends Controller
{
    public function list()
    {
        return view('templates.pages.scores_list');
    }

    public function datatblesList(Request $request)
    {
        $data = Score::orderBy('created_at', 'desc'); // Replace with your model and desired columns
        return DataTables::of($data)
            ->addColumn('actions', function (Score $score) {
                return '<div class="d-flex">
                        <a href="' . route('type.delete', $score->id) . '" class="mx-2"><i class="fa-solid fa-trash"></i></a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}
