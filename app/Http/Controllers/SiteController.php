<?php

namespace App\Http\Controllers;

use App\Mail\NotifRegisterSiswa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $post = \App\Post::all();
    	return view('sites.home', compact('post'));
    }

    public function contact()
    {
    	return view('sites.contact');
    }

    public function register()
    {
    	return view('sites.register');
    }

    public function postregister(Request $request)
    {
    	// dd($request->all());
    	// $this->validate($request,[
     //        'nama_depan' => 'required|min:3',
     //        'nama_belakang' => 'required',
     //        'email' => 'required|email|unique:users',
     //        'jenis_kelamin' => 'required',
     //        'agama' => 'required',
     //        'avatar' => 'mimes:jpg,png',
     //    ]);

        //Insert table user
        // dd($request->all());
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        //ini model untuk menyimpan data input ke database menggunakan static function yaitu disini adalah create
        //Insert table siswa
        // dd($request->all());
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());

        // \Mail::raw('Hello, Selamat Datang ' .$user->name, function ($message) use($user) {
        //     $message->to($user->email, $user->name);
        //     $message->subject('Selamat Anda Berhasil Mendaftarkan Diri Anda');
        // });

        \Mail::to($user->email)->send(new NotifRegisterSiswa);

        return redirect('/')->with('sukses','Pendafataran Berhasil Dilakukan');
    }

    public function singlepost($slug)
    {
        $post = \App\Post::where('slug','=',$slug)->first();
        // dd($post);
        return view('sites.singlepost', compact(['post']));
    }
}
