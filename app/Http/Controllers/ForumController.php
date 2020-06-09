<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $forum = \App\Forum::orderBy('created_at','desc')->paginate(5);

        return view('forum.index', compact(['forum']));
    }

    // public function create(Request $request)
    // {
    //     $request->request->add(['user_id' => auth()->user()->id]);

    //     $forum = \App\Forum::create($request->all());
    //     // dd($request->all());

    //     return redirect()->back()->with('sukses','Forum berhasil dibuat');

    // }

    public function details(Request $request, $id)
    {
        $forum = \App\Forum::with([
            'user','komentar'
        ])->findOrFail($id);

        // $forum->load(['komentar' => function($s) {
        //     $s->orderBy('id')->paginate(5);
        // }]);


        // dd($forum);
        return view('forum.details', compact(['forum']));
    }
}
