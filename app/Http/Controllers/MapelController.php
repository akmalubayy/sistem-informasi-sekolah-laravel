<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\Mapel;

class MapelController extends Controller
{

    public function index()
    {
       $mapel = Mapel::all();

        return view('mapel.index', compact(['mapel']));
    }

    public function store(Request $request, Guru $guru)
    {
        // $request->request->add(['guru_id' => $guru->id]);
        // $guru = Guru::find($id);
        // dd($request->all());
            Mapel::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'semester' => $request->semester,
                'guru_id' => $guru->id,
            ]);
        // Mapel::create([
        //     'kode' => $request->kode,
        //     'nama' => $request->nama,
        //     'semester' => $request->semester,
        //     'guru_id' => $guru->id,

        // ]);

        return redirect()->back()->with('sukses','Mata Pelajaran Berhasil DiTambah');
    }

}
