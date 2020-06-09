<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
    	$posts = \App\Post::all();
    	$users = \App\User::all();
    	// dd($post);
    	return view('posts.index', compact(['posts','users']));
    }

    public function add()
    {
		return view('posts.add');
    }

    public function create(Request $request)
    {
    	// dd($request->all());
    	$post = \App\Post::create([
    		'title' => $request->title,
    		'content' => $request->content,
    		'user_id' => auth()->user()->id,
    		'thumbnail' => $request->thumbnail,
    	]);

    	return redirect()->route('posts.index')->with('sukses','Berita Berhasil dipublish');
    }

     public function delete($id)
    {
    	$post = \App\Post::find($id);
    	$post->delete();

    	return redirect()->route('posts.index')->with('sukses','Berita Berhasil Dihapus');
    }

    public function edit($id)
    {
        $post = \App\Post::find($id);

        return view('posts.edit',compact(['post']));
        // return view('sites.singlepost', compact(['post']));
    }

    public function update(Request $request, $id) //dalam kurung adalah parameter
    {


        // $siswa = \App\Siswa::find($id);
        // $this->validate($request,[
        //     'nama_depan' => 'required|min:3',
        //     'nama_belakang' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'agama' => 'required',
        //     'avatar' => 'mimes:jpg,png',
        // ]);

        // dd($request->all());
        // $user = \App\User::find($id);
        $post = \App\Post::find($id);
        $post->update($request->all());
        // if($request->hasFile('avatar')){
        //     $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
        //     $siswa->avatar = $request->file('avatar')->getClientOriginalName();
        //     $siswa->save();
        // }
        return redirect()->route('posts.index')->with('sukses','Data berhasil diupdate');
    }
}
