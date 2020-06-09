<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
    	// Cara pemanggilan data siswa bisa begini
    	// $siswa = \App\Siswa::all();

    	// function map tersedia untuk chaining dengan object atau collection
    	// $siswa->map(function($s){
    	// 	$s->rataRataNilai = $s->hitung();
    	// 	return $s;
    	// });

    	// $siswa = $siswa->sortByDesc('rataRataNilai')->take(5);
    	// dd($siswa);

    	// atau juga bisa begini, namun jika ini perlu import dahulu model siswa pada bagian atas dengan use App\Siswa
    	// $siswa = Siswa::all();
    	// dd($siswa);

    	// ['siswa' => $siswa]); -> ini adalah melempar data untuk di looping pada dashboard index

    	// return view('dashboards.index',['siswa' => $siswa]);

    	return view('dashboards.index');
    }
}
