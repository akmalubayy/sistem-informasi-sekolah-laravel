<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);

        foreach ($collection as $key => $rowimport) {
        	if($key	>= 2){
        		$tanggal_lahir = ($rowimport[5] - 25569) * 86400;
        	\App\Siswa::create([
        		'user_id' => 100,
        		'nama_depan' => $rowimport[1],
        		'nama_belakang' => ' ',
        		'jenis_kelamin' => $rowimport[2],
        		'agama' =>  $rowimport[3],
        		'alamat' => $rowimport[4],
        		'tgl_lahir' => gmdate('Y-m-d', $tanggal_lahir),
        	]);
       	 }
       }     
    }
}
