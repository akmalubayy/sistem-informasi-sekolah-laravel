<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Exports\SiswaExport;
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SiswaController extends Controller
{
    public function index(Request $request) //class request berfungsi untuk menarik data string yang akan dicari
    {
        // dd($request->all());
        // untuk fungsi cari menggunakan if percabangan
        if ($request->has('cari')) { //method has adalah untuk mengecek apakah query string ada?
            $data_siswa = \App\Siswa::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            // Membuat Variable data siswa
            $data_siswa = \App\Siswa::all();
        }
        // Akan menggunakan helper laravel return view
        return view('siswa.index', ['data_siswa' => $data_siswa]); //data_siswa dalam kurung siku adalah string dan setelah panah adalah value dari key data_siswa
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required',
            'email' => 'required|email|unique:users',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpg,png',
        ]);

        //Insert table user
        // dd($request->all());
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt('rahasia');
        $user->remember_token = Str::random(60);
        $user->save();

        //ini model untuk menyimpan data input ke database menggunakan static function yaitu disini adalah create
        //Insert table siswa
        // dd($request->all());
        $request->request->add(['user_id' => $user->id]);
        $siswa = \App\Siswa::create($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data Berhasil Diinput');
        // with adalah fungsi untuk flashmessage agar memberi alert session, jadi pada 1 session saja alert akan muncul

        //ini untuk mengecek apakah form yang sudah kita input berhasil tertangkap/terecord, jika berhasil langsung eksekusi ke database
        // return $request->all();
    }

    //parameter $id diambil dari route yang menginisialisasikan edit by id
    public function edit(Request $request, $id)
    {
        //Variable baru yaitu siswa
        $user = \App\User::find($id);
        // dd($user);
        $siswa = \App\Siswa::find($id); //find disini adalah fungsu eloquent
        return view('siswa.edit', ['siswa' => $siswa, 'user' => $user]); //passing data dengan parameter array

        // dd($siswa);
    }

    public function update(Request $request, $id) //dalam kurung adalah parameter
    {


        // $siswa = \App\Siswa::find($id);
        $this->validate($request, [
            'nama_depan' => 'required|min:3',
            'nama_belakang' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes:jpg,png',
        ]);

        // dd($request->all());
        // $user = \App\User::find($id);
        $siswa = \App\Siswa::find($id);
        $siswa->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $siswa->avatar = $request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $siswa = \App\Siswa::find($id);
        $siswa->delete();

        return redirect('/siswa')->with('sukses', 'Data Berhasil Dihapus');
    }

    public function profile($id)
    {
        $siswa = \App\Siswa::find($id);
        $matapel = \App\Mapel::all();
        // dd($matapelajaran);

        // Data Chart Disiapkan
        $categories =  [];
        $data = [];

        foreach ($matapel as $mp) {
            if ($siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()) {
                $categories[] = $mp->nama;
                $data[] = $siswa->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }
        }
        // dd($data);
        // dd(json_encode($categories));

        return view('siswa.profile', ['siswa' => $siswa, 'matapel' => $matapel, 'categories' => $categories, 'data' => $data]);
    }

    public function addnilai(Request $request, $idsiswa)
    {
        $this->validate($request, [
            'nilai' => 'required:mapel_siswa',
        ]);
        // dd($request->all());
        $siswa = \App\Siswa::find($idsiswa);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('siswa/' . $idsiswa . '/profile')->with('error', 'Data Mata Pelajaran Sudah Ada!');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('siswa/' . $idsiswa . '/profile')->with('sukses', 'Data Nilai Berhasil Dimasukan');
    }

    public function deletenilai($idsiswa, $idmapel)
    {
        $siswa = \App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);
        return redirect()->back()->with('sukses', 'Data Nilai Berhasil Dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'Siswa.xlsx');
    }

    public function exportPDF()
    {

        // Load View Menggunakan HTML
        // $pdf = PDF::loadHTML('<h1>Data Siswa</h1>');

        // Tampilan Menggunakan Load View  PDF
        $siswa = \App\Siswa::all();
        $pdf = PDF::loadView('export.siswapdf', ['siswa' => $siswa]);
        return $pdf->download('SiswaPDF.pdf');
    }

    public function getdatasiswa()
    {
        $siswa = \App\Siswa::select('siswa.*');

        return \DataTables::eloquent($siswa)

            ->addColumn('nama_lengkap', function ($s) {
                return '<a href="siswa/' . $s->id . '/profile">' . $s->nama_lengkap() . '</a>';
            })

            // ->addColumn('nama_lengkap', function($s){
            //     return $s->nama_depan.' '.$s->nama_belakang;
            //  })

            ->addColumn('rata2nilai', function ($s) {
                return $s->hitung();
            })
            ->addColumn('aksi', function ($z) {

                return '<a href="/siswa/' . $z->id . '/edit" class="btn btn-warning btn-sm">Edit</a>
                <a href="#" class="btn btn-danger btn-sm deletesis" siswa-id=' . $z->id . '>Delete</a>';
            })

            ->rawColumns(['nama_lengkap', 'rata2nilai', 'aksi'])
            ->ToJson();
    }

    public function profilesaya()
    {
        $siswa = auth()->user()->siswa;
        return view('siswa.profilesaya', compact(['siswa']));
    }

    public function importexcel(Request $request)
    {
        Excel::import(new SiswaImport, $request->file('data_siswa'));
        // dd($request->all());

        return redirect('/siswa')->with('sukses', 'Data Berhasil DiImport');
    }
}
