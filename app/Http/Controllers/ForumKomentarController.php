<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\Komentar;

class ForumKomentarController extends Controller
{
    public function store(Request $request, Forum $forum)
    {
        // dd($request->all());
        Komentar::create([
            'forum_id' => $forum->id,
            'user_id' => auth()->id(),
            'konten' => $request->konten,

        ]);

        return redirect()->back()->with('sukses','Komentar Anda Berhasil');

    }
}
