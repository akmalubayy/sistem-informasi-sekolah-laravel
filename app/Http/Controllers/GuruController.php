<?php

namespace App\Http\Controllers;

// use App\Guru;

use App\Exports\GuruExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use App\Guru;


class GuruController extends Controller
{
    public function index(Request $request)
    {
        $data_guru = \App\Guru::all();

        return view('guru.index', compact(['data_guru']));
    }

    public function profile($id)
    {
    	$guru = \App\Guru::find($id);
    	return view('guru.profile',['guru' => $guru]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required|min:3',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        // dd($request->all());
        $guru = \App\Guru::create($request->all());
        // $siswa = \App\Siswa::create($request->all());

        return redirect('/guru')->with('sukses','Data Guru Berhasil Diinput');

    }

    public function edit(Request $request, $id)
    {
        $guru = \App\Guru::find($id);
         return view('guru.edit', compact(['guru']));

    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nama' => 'required|min:3',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $guru = \App\guru::find($id);
        $guru->update($request->all());
        $guru->save();

        return redirect('/guru')->with('sukses','Data Berhasil Terupdate');

    }

    public function delete(Guru $guru)
    {
        // karena pakai route model binding, maka perintah dibawah bisa dihilangkan, karena sudah di inisialisasi di atas dengan Guru $guru
        // $guru = \App\Guru::find($guru);
        $guru->delete();

        return redirect()->back()->with('sukses','Data Guru Berhasil Didelete');
    }

    public function exportExcel()
    {
        return Excel::download(new GuruExport, 'Guru.xlsx');
    }

    public function exportPDF()
    {
        // Load View Menggunakan HTML
        // $pdf = PDF::loadHTML('<h1>Data Siswa</h1>');

        // Tampilan Menggunakan Load View  PDF
        $guru = \App\Guru::all();
        $pdf = PDF::loadView('export.gurupdf',['guru' => $guru]);
        return $pdf->download('GuruPDF.pdf');
    }
}
